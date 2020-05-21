const { createCanvas, loadImage } = require('canvas');
const canvas = createCanvas(800, 800)
const ctx = canvas.getContext('2d')
const fs = require('fs')

let recept = (JSON.parse(process.argv[2].split("'").join("\"")));
const out = fs.createWriteStream('../../public/img/generated_feltetek/'+JSON.stringify(JSON.parse(JSON.stringify(recept)).sort())+'.png');
async function drawCanvas(){
    loadImage('../../public/img/generated_assets_defaults/default_base.png').then((image) => {
        ctx.drawImage(image, 0, 0, 800, 800);
    });
    recept.forEach(element => {
        loadImage('../../public/img/generated_assets/'+element+'.png').then((image) => {
            ctx.drawImage(image, 0, 0, 800, 800);
        });
    });
}
async function run(){
    await drawCanvas();

    let stream = canvas.createPNGStream();
    stream.pipe(out);
    out.on('finish', () =>  console.log('The PNG file was created.'));
}

run();
