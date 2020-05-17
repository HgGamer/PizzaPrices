const { createCanvas, loadImage } = require('canvas');
const canvas = createCanvas(800, 800)
const ctx = canvas.getContext('2d')
const fs = require('fs')



let recept =JSON.parse(process.argv[2]);
const out = fs.createWriteStream('../../public/img/generated_feltetek/'+JSON.stringify(JSON.parse(process.argv[2]).sort())+'.png');
async function drawCanvas(){
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
