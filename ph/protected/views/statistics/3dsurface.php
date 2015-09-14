<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js' , CClientScript::POS_END);
?>
<style>
body {
  overflow:hidden;
}
canvas {
    position:absolute;
}
</style>
<canvas id="canvas"></canvas>

<script type="text/javascript"		>
initT['animInit'] = function(){
	var bbCan = document.createElement("canvas"), // backbuffer
    bbCtx = bbCan.getContext("2d"),
    canvas = document.getElementById("canvas"), // render canvas
    ctx = canvas.getContext("2d");

var size = 16,
    size1 = 17,
    width = window.innerWidth,
    height = 500,
    perspective = height,
    points = [],
    particles = [],
    noiseLayers = [],
    noiseTime = new Date().getTime(),
    noiseMin = 60,
    curLayer = 0,
    sunThrob = 0,
    isThrob = false,
    radialGrad = null,
    setPoint = function (x, y, z, color, nodes) {
        this.xp = x;
        this.yp = y;
        this.zp = z;
        this.angle = 50 - Math.random() * 100;
        this.x = this.y = this.z = 0;
        this.color = color;
        this.nodes = nodes;
        return this;
    },
    particle = function () {
        this.reset = function () {
            this.xp = 0;
            this.yp = 0;
            this.zp = 500;

            this.velX = 1 - (Math.random() * 2);
            this.velY = 1 - (Math.random() * 2);
            this.x = this.y = this.z = 0;
        }
        this.reset();
    };



function init() {
    for (var x = 0; x < size; x++) {
        for (var y = 0; y < size; y++) {
            var xPos = -3000 + x * 500,
                zPos = 10 + y * 200,
                yPos = 455 + Math.random() * 30;

            points[y * size1 + x] = new setPoint(xPos, yPos, zPos, [250, 242, 245], [
            ((y + 1) * size1) + x, (y + 1) * size1 + (x + 1), (y * size1) + (x + 1)]);
        }
    }

    for (var p = 0; p < 50; p++) {
        particles.push(new particle());
    }

    for (var n = 0; n < 10; n++) {
        var nCanvas = document.createElement("canvas"),
            nCtx = nCanvas.getContext("2d"),
            pix = 0;

        nCanvas.width = width;
        nCanvas.height = height;
      
        var nImageData = nCtx.createImageData(width, height),
            nData = nImageData.data;

        for (x = 0; x < width; x++) {
            for (y = 0; y < height; y++) {
                if (Math.random() > 0.9) {
                    for (var w = 0; w < 3; w++) {
                        pix = ((x + w) + y * width) * 4;
                        nData[pix] = 255;
                        nData[pix + 1] = 255;
                        nData[pix + 2] = 255;
                        nData[pix + 3] = 20;
                    }
                }
            }
        }
        nCtx.putImageData(nImageData, 0, 0);
        noiseLayers.push(nCanvas);
    }

    // gradient
    radialGrad = ctx.createRadialGradient(width/2, width/4, height/4, width/2, height/2, width);
    radialGrad.addColorStop(0, 'rgba(250,245,250,0.2)');
    radialGrad.addColorStop(1, 'rgba(100,80,90,0.8)');  

    // helps blur more    
    ctx.globalAlpha = 0.4;
    render();
}

// render loop
function render() {
    bbCtx.clearRect(0, 0, width, height);

    // Render the particles
    for (var p = 0; p < particles.length; p++) {
        var particle = particles[p];

        particle.xp += particle.velX;
        particle.yp += particle.velY;

        scl = perspective / particle.zp;
        particle.x = width/2 + particle.xp * scl;
        particle.y = 64 + particle.yp * scl;
        var dist = Math.sqrt(particle.xp * particle.xp + particle.yp * particle.yp),
            alpha = 0.8 - dist * 0.004;

        bbCtx.fillStyle = "rgba(60,40,50," + alpha + ")";
        bbCtx.fillRect(particle.x, particle.y, scl * 2, scl * 2);

        if (alpha <= 0) {
            particle.reset()
        }
    }

    // render the sun
    if (isThrob) {
        sunThrob++;
    } else {
        sunThrob += 0.08;
    }

    if (sunThrob >= 5) {
        sunThrob = 0;
        if (!isThrob) {
            sunThrob = -2;
        }
        isThrob = !isThrob;
    }

    bbCtx.fillStyle = "rgb(60,40,50)";
    bbCtx.arc(width/2, 120, 100 + Math.sin(sunThrob) * 8, 0, Math.PI * 2);
    bbCtx.fill();

    // render the grid
    for (j = size - 1; j >= 0; j--) {
        for (i = 0; i < size; i++) {
            var point = points[j * size1 + i],
                px = point.xp,
                py = point.yp,
                pz = point.zp,
                color = point.color,
                cosY = Math.cos(0.03),
                sinY = Math.sin(0.03);

            // the motion
            points[j * size1 + i].angle += 0.12;
            points[j * size1 + i].yp += Math.sin(points[j * size1 + i].angle) * 3;

            scl = perspective / pz;
            point.x = width/2 + px * scl;
            point.y = 64 + py * scl;

            // connects all the points
            bbCtx.beginPath();
            bbCtx.moveTo(~~ (point.x), ~~ (point.y));

            for (ve = 0; ve < 3; ve++) {
                if (points[point.nodes[ve]] !== undefined) {
                    bbCtx.lineTo(~~ (points[point.nodes[ve]].x), ~~ (points[point.nodes[ve]].y));
                }
            }

            // connect the corners
            bbCtx.moveTo(~~ (point.x), ~~ (point.y));
            if (points[point.nodes[1]] !== undefined) {
                bbCtx.lineTo(~~ (points[point.nodes[1]].x), ~~ (points[point.nodes[1]].y));
            }
            bbCtx.closePath();
            /* 
                hack shading. Not correct shading at all, but looks close enough w/o 
                having to create some actual lighting
            */

            var red = ~~ (color[0] + ((455 - point.yp)) + point.zp * 0.01),
                green = ~~ (color[1] + ((455 - point.yp)) + point.zp * 0.01),
                blue = ~~ (color[2] + ((455 - point.yp)) + point.zp * 0.01);

            bbCtx.fillStyle = 'rgb(' + red + ',' + green + ',' + blue + ')';
            bbCtx.fill();
            bbCtx.strokeStyle = "rgba(60,40,50,0.3)";
            bbCtx.stroke();

            // creates the points inbetween each connection
            bbCtx.beginPath();
            bbCtx.arc(point.x, point.y, scl * 6, 0, Math.PI * 2, true);
            bbCtx.closePath();
            bbCtx.fillStyle = 'rgb(60,40,50)';
            bbCtx.fill();
            bbCtx.stroke();

        }
    }

    if (new Date().getTime() > noiseTime + noiseMin) {
        noiseTime = new Date().getTime();
        curLayer++;
        if (curLayer > noiseLayers.length - 1) {
            curLayer = 0;
        }
    }
    bbCtx.drawImage(noiseLayers[curLayer], 0, 0);

    // draw the backbuffer to the display canvas
    ctx.fillStyle = "rgba(255,255,255,0.1)";
    ctx.fillRect(0, 0, width, height);
    ctx.drawImage(bbCan, 0, 0);

    ctx.fillStyle = radialGrad;
    ctx.fillRect(0, 0, width, height);

    requestAnimationFrame(render);
}

setTimeout(function(){
  width = window.innerWidth;
  height = window.innerHeight;
  perspective = height;
  canvas.width = bbCan.width = width;
  canvas.height = bbCan.height = height;
  
  init();
},200);
};
</script>	