<?php

namespace App\Lib;

use App\DataProtectionLink;
use Illuminate\Support\Facades\Log;
use Goutte\Client as GoutteClient;
use Illuminate\Support\Facades\Hash;


class DataProtectionScraper
{
    public $client;

    public $results = [];

    public $savedItems = 0;

    public $status = 1;

    public function __construct(GoutteClient $client)
    {
        $this->client = $client;
    }

    public function handle($linkObj)
    {

        try {
            //Log::debug("trybe");
            $crawler = $this->client->request('GET', $linkObj->url);

            if ($linkObj->url == "http://www.pizzaguru.hu/etlap") {
                $crawler = $this->client->click($crawler->selectLink('Hungarian')->link());
            }

            $translateExpre = $this->translateCSSExpression($linkObj->itemSchema->css_expression);


            if (isset($translateExpre['text'])) {
                //Log::debug("issetbe");
                $data = [];

                // filter
                $crawler->filter($linkObj->main_filter_selector)->each(function ($node) use ($translateExpre, &$data, $linkObj) {
                    foreach ($translateExpre as $key => $val) {

                        if($node->filter($val['selector'])->count() > 0) {

                            if ($val['is_attribute'] == false) {

                                if ($linkObj->website_id== 8) {
                                    $data[$key][] = preg_replace("#\n|'|\"#",'', $node->filter($val['selector'])->html());
                                }else{
                                    $data[$key][] = preg_replace("#\n|'|\"#",'', $node->filter($val['selector'])->text());
                                }

                            } else {

                                $data[$key][] = $node->filter($val['selector'])->attr($val['attr']);

                            }
                        }
                    }

                    $data['category_id'][] = $linkObj->category->id;

                    $data['website_id'][] = $linkObj->website->id;

                    if (!isset($data['size'])) {
                        $data['sizeObj'] = isset($linkObj->itemSchema->pizza_size) ? $linkObj->itemSchema->pizza_size : "";
                    }

                });

                return $data;
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getMessage();
        }
    }


    protected function translateCSSExpression($expression)
    {
        $exprArray = explode("||", $expression);

        // try to match split that expression into pieces
        $regex = '/(.*?)\[(.*)\]/m';

        $fields = [];

        foreach ($exprArray as $subExpr) {

            preg_match($regex, $subExpr, $matches);

            if(isset($matches[1]) && isset($matches[2])) {

                $is_attribute = false;

                $selector = $matches[2];

                $attr = "";

                // if this condition meets then this is attribute like img[src] or a[href]
                if (strpos($selector, "[") !== false && strpos($selector, "]") !== false) {

                    $is_attribute = true;

                    preg_match($regex, $matches[2], $matches_attr);

                    $selector = $matches_attr[1];

                    $attr = $matches_attr[2];
                }

                $fields[$matches[1]] = ['field' => $matches[1], 'is_attribute' => $is_attribute, 'selector' => $selector, 'attr' => $attr];
            }
        }

        return $fields;
    }
}
