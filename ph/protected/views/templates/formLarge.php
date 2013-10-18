<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css');
$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/autosize.js/1.17.1/autosize-min.js' , CClientScript::POS_END);
?>
<style>
textarea.form-control {
  resize:vertical;
/*vertical-align: top;
transition: height 0.2s;
-webkit-transition: height 0.2s;
-moz-transition: height 0.2s;*/
}

select.form-control {
  -webkit-appearance: none;
  -moz-appearance: none;
}

@media (min-width: 768px) {

form.no-padding div[class*=col-]:not(.col-md-12).left {
  padding-left: 3px;
}

form.no-padding div[class*=col-]:not(.col-md-12).right {
  padding-right: 3px;
}

}

form.no-padding .form-group {
  margin-bottom: 6px;
}

.form-control {
  background-color: transparent;
  border: 0;
  line-height: 2;
  height: auto;
  padding: 10px;
  text-transform: uppercase;
  font-weight: bolder;
  box-shadow: none;
  border: 1px solid #ddd;
}

.select:after {
position: absolute;
top: 24px;
right: 25px;
z-index: 2;
display: inline-block;
width: 0;
height: 0;
margin-left: 2px;
vertical-align: middle;
border-top: 4px solid #000000;
border-right: 4px solid transparent;
border-bottom: 0 dotted;
border-left: 4px solid transparent;
content: "";
border-top-color: #333;
}

.form-control:hover {
  background-color: #f0f0f0;
}

.form-control:focus {
  border-color: rgb(52, 152, 219);
  box-shadow: 0 0 12px rgba(52, 152, 219,.6);
  background-color: #fff;
  animation: fadeInput 1s infinite alternate ease-in-out;
}

@keyframes fadeInput
{
  from {box-shadow: 0 0 6px rgba(52, 152, 219,.2);}
  to {box-shadow: 0 0 12px rgba(52, 152, 219,.6);}
}

select[required],
input[required] {
  border-left: 4px solid #e74c3c;
}


.is-error {
  border-color: #e74c3c!important;
  color: #e74c3c!important;
}

.is-success {
  border-color: #1abc9c!important;
  color: #1abc9c!important;
}
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>Contato</h1>
      
      <form class="no-padding">
        <div class="form-group">
          <label for class="control-label sr-only">Nome</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" placeholder="Nome" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Email</label>
          <div class="col-sm-12">
            <input type="email" name="email" required class="form-control" placeholder="Email" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Telefone</label>
          <div class="col-sm-6 right">
            <input type="text" class="form-control" placeholder="Telefone" />
          </div>
        </div>
        <div class="form-group clearfix">
          <label for class="control-label sr-only">Celular</label>
          <div class="col-sm-6 left">
            <input type="text" class="form-control" placeholder="Celular" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">URL</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" placeholder="URL" />
          </div>
        </div>
        
        
        
        <div class="form-group">
          <label for class="control-label sr-only">Facebook</label>
          <div class="col-sm-4 right">
            <input type="text" class="form-control" placeholder="Facebook" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Twitter</label>
          <div class="col-sm-4 right left">
            <input type="text" class="form-control" placeholder="Twitter" />
          </div>
        </div>
        <div class="form-group clearfix">
          <label for class="control-label sr-only">Hangout / Gtalk</label>
          <div class="col-sm-4 left">
            <input type="text" class="form-control" placeholder="Hangout / Gtalk" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">LinkedIn</label>
          <div class="col-sm-4 right">
            <input type="text" class="form-control" placeholder="LinkedIn" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Behance</label>
          <div class="col-sm-4 right left">
            <input type="text" class="form-control" placeholder="Behance" />
          </div>
        </div>
        <div class="form-group clearfix">
          <label for class="control-label sr-only">Skype</label>
          <div class="col-sm-4 left">
            <input type="text" class="form-control" placeholder="Skype" />
          </div>
        </div>
        
        
        
        <div class="form-group">
          <label for class="control-label sr-only">Empresa</label>
          <div class="col-sm-6 right">
            <input type="text" class="form-control" placeholder="Empresa" />
          </div>
        </div>
        <div class="form-group clearfix">
          <label for class="control-label sr-only">Cargo</label>
          <div class="col-sm-6 left">
            <input type="text" class="form-control" placeholder="Cargo" />
          </div>
        </div>
        
        <div class="form-group">
          <label for class="control-label sr-only">Endereço</label>
          <div class="col-sm-5 right">
            <input type="text" class="form-control" placeholder="Endereço" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Nº</label>
          <div class="col-sm-2 right left">
            <input type="text" class="form-control" placeholder="Nº" />
          </div>
        </div>
        <div class="form-group clearfix">
          <label for class="control-label sr-only">Complemento</label>
          <div class="col-sm-5 left">
            <input type="text" class="form-control" placeholder="Complemento" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Bairro</label>
          <div class="col-md-6 col-sm-5 right">
            <input type="text" class="form-control" placeholder="Bairro" />
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Cidade</label>
          <div class="col-sm-5 right left">
            <input type="text" class="form-control" placeholder="Cidade" />
          </div>
        </div>
        <div class="form-group clearfix">
          <label for class="control-label sr-only">UF</label>
          <div class="col-md-1 col-sm-2 left select">
            <select name="" class="form-control" required>
              <option value="">UF</option>
              <option value="AC">AC</option>
              <option value="AL">AL</option>
              <option value="AP">AP</option>
              <option value="AM">AM</option>
              <option value="BA">BA</option>
              <option value="CE">CE</option>
              <option value="DF">DF</option>
              <option value="ES">ES</option>
              <option value="GO">GO</option>
              <option value="MA">MA</option>
              <option value="MT">MT</option>
              <option value="MS">MS</option>
              <option value="MG">MG</option>
              <option value="PA">PA</option>
              <option value="PB">PB</option>
              <option value="PR">PR</option>
              <option value="PE">PE</option>
              <option value="PI">PI</option>
              <option value="RJ">RJ</option>
              <option value="RN">RN</option>
              <option value="RS">RS</option>
              <option value="RO">RO</option>
              <option value="RR">RR</option>
              <option value="SC">SC</option>
              <option value="SP">SP</option>
              <option value="SE">SE</option>
              <option value="TO">TO</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for class="control-label sr-only">Mensagem</label>
          <div class="col-sm-12">
            <textarea class="form-control" placeholder="Escreva sua mensagem"></textarea>
          </div>
        </div>
      </form>
      
</div></div></div>

    </div></div>

<script type="text/javascript"		>
initT['animInit'] = function(){
	$('textarea').autosize(); 
};
</script>