

<!-- BLOCK CSS -->
<style>
@import url(http://fonts.googleapis.com/css?family=Lato:100,300,700);
/* Loader #2 by Sam Lillicrap
   http://www.samueljwebdesign.co.uk
   http://codepen.io/samueljweb/pen/bGKwk
*/
html {
  background-color: #27ae60;
}

h1 {
  font-family: 'Lato';
  color: white;
  text-transform: uppercase;
  font-size: 1em;
  letter-spacing: 1.5px;
  text-align: center;
  width: 90px;
  margin-top: 20px;
  -webkit-animation: fade 2s infinite;
}

.container {
  width: 110px;
  padding-top: 180px;
  margin: auto;
  vertical-align: middle;
}

.ex {
  font-family: 'Lato';
  color: white;
  text-transform: uppercase;
  font-size: 1em;
  letter-spacing: 1.5px;
  text-align: center;
  width: 90px;
  margin-top: 20px;
  -webkit-animation: fade 2s infinite;
  font-family: 'flamenco';
  font-size: 4em;
  width: 40px;
  height: 40px;
  margin-top: -17px;
  display: inline-block;
  border: 4px double white;
}

.ex:nth-child(1) {
  -webkit-animation: spin1 3s infinite 1s;
  -webkit-transform-origin: 50% 52%;
  margin-left: 10px;
}

.ex:nth-child(2) {
  -webkit-animation: spin2 3s infinite 1s;
  -webkit-transform-origin: 50% 52%;
  margin-left: -20px;
}

.ex:nth-child(3) {
  -webkit-animation: spin2 3s infinite 1s;
  -webkit-transform-origin: 50% 52%;
  margin-left: 10px;
}

.ex:nth-child(4) {
  margin-left: -1px;
  -webkit-animation: spin1 3s infinite 1s;
  -webkit-transform-origin: 50% 52%;
  margin-left: -20px;
}

@-webkit-keyframes spin1 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
  }
}

@-moz-keyframes spin1 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
  }
}

@-o-keyframes spin1 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spin1 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
  }
}

@-webkit-keyframes spin2 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(-360deg);
  }
}

@-moz-keyframes spin2 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(-360deg);
  }
}

@-o-keyframes spin2 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(-360deg);
  }
}

@keyframes spin2 {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(-360deg);
  }
}

@-webkit-keyframes fade {
  50% {
    opacity: 0.5;
  }

  100% {
    opacity: 1;
  }
}

@-moz-keyframes fade {
  50% {
    opacity: 0.5;
  }

  100% {
    opacity: 1;
  }
}

@-o-keyframes fade {
  50% {
    opacity: 0.5;
  }

  100% {
    opacity: 1;
  }
}

@keyframes fade {
  50% {
    opacity: 0.5;
  }

  100% {
    opacity: 1;
  }
}

</style>

<!-- BLOCK HTML  -->

<div class="container">
  <div class="ex"></div>
  <div class="ex"></div>
  <div class="ex"></div>
  <div class="ex"></div>
  <h1>Loading...</h1>
</div>

