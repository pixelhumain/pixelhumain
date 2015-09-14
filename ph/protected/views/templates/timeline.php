<style>
/* -------------------------------------
 * General Style
 * ------------------------------------- */
.hero-unit {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 5%;
  font-size: 100%;
  font-family: "Lucida Grande", Lucida, Verdana, sans-serif;
  color: #eee9dc;
  background: #48b379;
}

a {
  color: inherit;
  text-decoration: none;
}

h2 {
  margin: 3em 0 0.75em 0;
  font-size: 1.375em;
  letter-spacing: 2px;
  text-transform: uppercase;
}

/* -------------------------------------
 * timeline
 * ------------------------------------- */
#timeline {
  list-style: none;
  margin: 50px 0 30px 120px;
  padding-left: 30px;
  border-left: 8px solid #eee9dc;
}
#timeline li {
  margin: 40px 0;
  font-size: 1.375em;
  line-height: 1.3;
  position: relative;
}
#timeline p {
  margin: 0 0 15px;
}

.date {
  margin-top: -10px;
  font-size: 0.75em;
  line-height: 20px;
  position: absolute;
  top: 50%;
  left: -158px;
}

.circle {
  width: 10px;
  height: 10px;
  margin-top: -10px;
  background: #48b379;
  border: 5px solid #eee9dc;
  border-radius: 50%;
  display: block;
  position: absolute;
  top: 50%;
  left: -44px;
}

.content {
  max-height: 20px;
  padding: 55px 20px 0;
  border-width: 2px;
  border-style: solid;
  border-color: transparent;
  border-radius: 0.5em;
  position: relative;
}
.content:before, .content:after {
  content: "";
  width: 0;
  height: 0;
  border: solid transparent;
  position: absolute;
  right: 100%;
  pointer-events: none;
}
.content:before {
  border-right-color: inherit;
  border-width: 20px;
  top: 50%;
  margin-top: -20px;
}
.content:after {
  border-right-color: #48b379;
  border-width: 17px;
  top: 50%;
  margin-top: -17px;
}
.content p {
  max-height: 0;
  color: transparent;
  font-size: 0.8em;
  overflow: hidden;
}

label {
  position: absolute;
  top: 20px;
  z-index: 100;
  cursor: pointer;
  transition: transform 0.2s linear;
}

.radio {
  display: none;
}

.radio:checked + label {
  cursor: auto;
  transform: translateX(42px);
}
.radio:checked ~ .circle {
  background: #f98262;
}
.radio:checked ~ .content {
  max-height: 200px;
  margin-right: 20px;
  border-color: #eee9dc;
  transition: max-height 0.5s linear, border-color 0.5s linear, transform 0.2s linear;
  transform: translateX(20px);
}
.radio:checked ~ .content p {
  max-height: 200px;
  color: #eee9dc;
  transition: color 0.3s linear 0.3s;
}
.radio:checked ~ .content a {
  color: #327c54;
  transition: color 0.3s linear 0.3s;
}

/* -------------------------------------
 * mobile phones
 * ------------------------------------- */
@media screen and (max-width: 767px) {
  body {
    font-size: 70%;
  }

  #timeline {
    margin-left: 0;
    padding-left: 0;
    border-left: none;
  }
  #timeline li {
    margin: 50px 0;
  }

  label {
    width: 85%;
    font-size: 1.1em;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    display: block;
    transform: translateX(18px);
  }

  .content {
    padding-top: 45px;
    border-color: #eee9dc;
  }
  .content:before, .content:after {
    border: solid transparent;
    bottom: 100%;
  }
  .content:before {
    border-bottom-color: inherit;
    border-width: 17px;
    top: -16px;
    left: 50px;
    margin-left: -17px;
  }
  .content:after {
    border-bottom-color: #48b379;
    border-width: 20px;
    top: -20px;
    left: 50px;
    margin-left: -20px;
  }
  .content p {
    font-size: 0.9em;
    line-height: 1.4;
  }

  .circle, .date, #download {
    display: none;
  }
}

</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    	
<h2>Lorem ipsum</h2>
<ul id='timeline'>
  <li class='work'>
    <input class='radio' id='work5' name='works' type='radio' checked>
    <label for='work5'>Lorem ipsum dolor sit amet</label>
    <span class='date'>12 May 2013</span>
    <span class='circle'></span>
    <div class='content'>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio ea necessitatibus quo velit natus cupiditate qui alias possimus ab praesentium nostrum quidem obcaecati nesciunt! Molestiae officiis voluptate excepturi rem veritatis eum aliquam qui laborum non ipsam ullam tempore reprehenderit illum eligendi cumque mollitia temporibus! Natus dicta qui est optio rerum.
      </p>
    </div>
  </li>
  <li class='work'>
    <input class='radio' id='work4' name='works' type='radio'>
    <label for='work4'>Lorem ipsum dolor sit amet</label>
    <span class='date'>11 May 2013</span>
    <span class='circle'></span>
    <div class='content'>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio ea necessitatibus quo velit natus cupiditate qui alias possimus ab praesentium nostrum quidem obcaecati nesciunt! Molestiae officiis voluptate excepturi rem veritatis eum aliquam qui laborum non ipsam ullam tempore reprehenderit illum eligendi cumque mollitia temporibus! Natus dicta qui est optio rerum.
      </p>
    </div>
  </li>
  <li class='work'>
    <input class='radio' id='work3' name='works' type='radio'>
    <label for='work3'>Lorem ipsum dolor sit amet</label>
    <span class='date'>10 May 2013</span>
    <span class='circle'></span>
    <div class='content'>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio ea necessitatibus quo velit natus cupiditate qui alias possimus ab praesentium nostrum quidem obcaecati nesciunt! Molestiae officiis voluptate excepturi rem veritatis eum aliquam qui laborum non ipsam ullam tempore reprehenderit illum eligendi cumque mollitia temporibus! Natus dicta qui est optio rerum.
      </p>
    </div>
  </li>
  <li class='work'>
    <input class='radio' id='work2' name='works' type='radio'>
    <label for='work2'>Lorem ipsum dolor sit amet</label>
    <span class='date'>09 May 2013</span>
    <span class='circle'></span>
    <div class='content'>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio ea necessitatibus quo velit natus cupiditate qui alias possimus ab praesentium nostrum quidem obcaecati nesciunt! Molestiae officiis voluptate excepturi rem veritatis eum aliquam qui laborum non ipsam ullam tempore reprehenderit illum eligendi cumque mollitia temporibus! Natus dicta qui est optio rerum.
      </p>
    </div>
  </li>
  <li class='work'>
    <input class='radio' id='work1' name='works' type='radio'>
    <label for='work1'>Lorem ipsum dolor sit amet</label>
    <span class='date'>08 May 2013</span>
    <span class='circle'></span>
    <div class='content'>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio ea necessitatibus quo velit natus cupiditate qui alias possimus ab praesentium nostrum quidem obcaecati nesciunt! Molestiae officiis voluptate excepturi rem veritatis eum aliquam qui laborum non ipsam ullam tempore reprehenderit illum eligendi cumque mollitia temporibus! Natus dicta qui est optio rerum.
      </p>
    </div>
  </li>
</ul>
    
    </div></div>
    
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>