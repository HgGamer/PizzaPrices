const { createCanvas, loadImage } = require('canvas');
const res = 256;
const res_big = 512;

const canvas = createCanvas(res, res)
const canvas_big = createCanvas(res_big, res_big)
const ctx = canvas.getContext('2d')
const ctx_big = canvas_big.getContext('2d')
const fs = require('fs')

let recept = (JSON.parse(process.argv[2].split("'").join("\"")));
const out = fs.createWriteStream('../../public/img/generated_feltetek/'+JSON.stringify(JSON.parse(JSON.stringify(recept)).sort())+'.png');
const out_big = fs.createWriteStream('../../public/img/generated_feltetek_big/'+JSON.stringify(JSON.parse(JSON.stringify(recept)).sort())+'.png');
async function drawCanvas(){
    loadImage('../../public/img/generated_assets_defaults/default_base.png').then((image) => {
        ctx.drawImage(image, 0, 0, res, res);
        ctx_big.drawImage(image, 0, 0, res_big, res_big);
    });
    recept.forEach(element => {
        loadImage('../../public/img/generated_assets/'+element+'.png').then((image) => {
            ctx.drawImage(image, 0, 0, res, res);
            ctx_big.drawImage(image, 0, 0, res_big, res_big);
        });
    });
}
async function run(){
    await drawCanvas();
    let stream = canvas.createPNGStream();
    let stream_big = canvas_big.createPNGStream();
    stream.pipe(out);
    stream_big.pipe(out_big);
    out.on('finish', () =>  console.log('The PNG file was created.'));
    out_big.on('finish', () =>  console.log('The PNG file was created.'));
}

run();
