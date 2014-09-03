/* -------------------- This is images.js ----------------------
 * SLFWPM - Simple Login Form With PM Messages by Vaseto.net
 * This is config file for Simple PM Message by Vaseto^^ 2014.
 * More at: (VasilSLavchev.net or vasilslavchev@gmail.com).
 * https://bitbucket.org/VasilSlavchev/simpleloginformwithpm
 * This project is under creative commons license: CC BY-NC-SA.
 * https://creativecommons.org/licenses/by-nc-sa/2.5/bg/
 * https://creativecommons.org/licenses/by-nc-sa/2.5/bg/deed.en
 * -------------------- This is images.js --------------------*/
    var bgImage = new Array();
        bgImage[0] = 'images/background.jpg';
        bgImage[1] = 'images/background1.jpg';
        bgImage[2] = 'images/background2.jpg';
        bgImage[3] = 'images/background3.jpg';
        bgImage[4] = 'images/background4.jpg';
        bgImage[5] = 'images/background5.jpg';
        bgImage[6] = 'images/background6.jpg';
        bgImage[7] = 'images/background7.jpg';
        bgImage[8] = 'images/background8.jpg';

        isMax = bgImage.length-1;
        currImg = 0+Math.round(Math.random()*isMax);

        window.onload = function(){

        isImg = bgImage[currImg];
        document.body.style.backgroundImage = "url("+isImg+")"
    }