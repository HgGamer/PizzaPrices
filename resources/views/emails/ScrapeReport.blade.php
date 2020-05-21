<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            .red {
                background-color: red;
            }
            .blue{
                background-color: lightskyblue;
            }
            .green{
                background-color: greenyellow;
            }
        </style>

    </head>
<body>
<h1>Scrape by <strong>{{ $name }}</strong></h1>

<h2>Report: </h2>


<table style="width:100%;text-align:center;">
    <h4>Pizzas by website: </h4>
    <tr>
      <th style="width: 10%;">Id</th>
      <th  style="width: 30%;">Restaurant</th>
      <th style="width: 15%;">New Pizzas count</th>
      <th style="width: 15%;">Old Pizzas Count</th>
      <th style="width: 30%;">Change</th>
    </tr>
    @foreach ($newWebsitesData as $newWebsiteData)
        <tr class="{{ $newWebsiteData->raw_data_number == 0 ? "red" : "" }}">
            <td style="width: 10%;">{{$newWebsiteData->id}}</td>
            <td style="width: 30%;">{{$newWebsiteData->title}}</td>
            <td style="width: 15%;">{{$newWebsiteData->raw_data_number}}</td>
            <td style="width: 15%;">{{$newWebsiteData->oldPizzasCount}}</td>
            <td style="width: 30%;" class="{{ $newWebsiteData->pieceDiferrence == "More pizza" ||  $newWebsiteData->pieceDiferrence == "Less pizza"? "blue" : ""}}">{{ $newWebsiteData->pieceDiferrence }} <span style="font-size: 21px; font-weight: bold;">{{ $newWebsiteData->pieceDiferrence == "More pizza" ? "↑" : ""}}{{ $newWebsiteData->pieceDiferrence == "Less Pizza" ? "↓" : ""}}</span></td>
        </tr>
    @endforeach
  </table>

  <table style="width:100%;text-align:center;">
    <h4>New pizzas: </h4>
    <tr>
      <th style="width: 10%;">Id</th>
      <th style="width: 30%;">Title</th>
      <th style="width: 15%;">Size</th>
      <th style="width: 15%;">Price</th>
      <th style="width: 30%;">Website</th>
    </tr>
    @foreach ($newPizzas as $newPizza)
        <tr >
            <td style="width: 10%;">{{$newPizza->id}}</td>
            <td style="width: 30%;">{{$newPizza->title}}</td>
            <td  style="width: 15%;">{{$newPizza->size}}</td>
            <td  style="width: 15%;">{{$newPizza->price}}</td>
            <td style="width: 30%;">{{ $newPizza->websiteName }}</td>
        </tr>
    @endforeach
  </table>

  <table style="width:100%;text-align:center;">
    <h4>Price changed Pizzas: </h4>
    <tr>
      <th style="width: 10%;">Id</th>
      <th style="width: 30%;">Title</th>
      <th style="width: 10%;">Size</th>
      <th style="width: 10%;">Price</th>
      <th style="width: 30%;">Website</th>
      <th style="width: 10%;">Price change</th>
    </tr>
    @foreach ($priceChangedPizzas as $priceChangedPizza)
        <tr>
            <td style="width: 10%;">{{$priceChangedPizza->id}}</td>
            <td style="width: 30%;">{{$priceChangedPizza->title}}</td>
            <td style="width: 10%;">{{$priceChangedPizza->size}}</td>
            <td style="width: 10%;">{{$priceChangedPizza->price}}</td>
            <td style="width: 30%;">{{ $priceChangedPizza->websiteName}}</td>
            <td style="width: 10%;" class="{{ $priceChangedPizza->priceDiferrence < 0 ? "green" : "red"}}">{{ $priceChangedPizza->priceDiferrence }}</td>
        </tr>
    @endforeach
  </table>

</body>
</html>
