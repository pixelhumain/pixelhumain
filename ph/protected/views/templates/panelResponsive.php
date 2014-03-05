

<!-- BLOCK CSS -->
<style>
.container {
  padding: 10px;
}

p {
  text-align: center;
  font-weight: bold;
}

.box-content {
  padding: 20px;
}

.box-cell {
  margin-bottom: 10px;
}
.box-cell.one {
  background-color: #f26e11;
}
.box-cell.two {
  background-color: #84B2A1;
}
.box-cell.three {
  background-color: #F9EDC7;
}

@media only screen and (min-width: 720px) {
  .boxes {
    display: table;
    width: 100%;
  }

  .box-row {
    display: table-row;
  }

  .box-cell {
    display: table-cell;
    vertical-align: top;
    width: 33.333333333%;
  }
  .box-cell.one {
    border-right: 5px solid #fff;
  }
  .box-cell.two {
    border-left: 5px solid #fff;
    border-right: 5px solid #fff;
  }
  .box-cell.three {
    border-left: 5px solid #fff;
  }
}

</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">

<p>
    Responsive equal height columns with a clever way to get a constant 10px gap between the boxes
  </p>

  <div class="boxes">
    <div class="box-row">
      <div class="box-cell one">
        <div class="box-content">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur elementum mollis lorem at luctus. Maecenas iaculis nisl libero, quis consectetur mauris aliquet a. 
        </div>
      </div>

      <div class="box-cell two">
        <div class="box-content">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur elementum mollis lorem at luctus. Maecenas iaculis nisl libero, quis consectetur mauris aliquet a. Curabitur elementum mollis lorem at luctus. Maecenas iaculis nisl libero, quis consectetur mauris aliquet a.
        </div>
      </div>

      <div class="box-cell three">
        <div class="box-content">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur elementum mollis lorem at luctus. Maecenas iaculis nisl libero, quis consectetur mauris aliquet a. 
        </div>
      </div>
    </div>
  </div>

	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>