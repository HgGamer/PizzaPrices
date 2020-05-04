const { createCanvas, loadImage } = require('canvas')
const canvas = createCanvas(800, 600)
const ctx = canvas.getContext('2d')
const fs = require('fs')
const out = fs.createWriteStream('generated/'+process.argv[2]+'.png');
let recept =JSON.parse(process.argv[2]); 
async function drawCanvas(){
    recept.forEach(element => {
        loadImage('assets/'+element+'.png').then((image) => {
            ctx.drawImage(image, 0, 0, 800, 600);
        });
      
    });
}
async function run(){
    await drawCanvas();
    let stream = canvas.createPNGStream()
    stream.pipe(out)
    out.on('finish', () =>  console.log('The PNG file was created.'))
}

run();