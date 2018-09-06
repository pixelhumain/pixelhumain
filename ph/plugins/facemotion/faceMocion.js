(function($) {
	$.fn.extend({
		faceMocion: function(opciones) {

			var faceMocion = this;
			var NombreSelector = "Selector";
			var DescripcionFace = "--";
			defaults = {
				emociones: [{
					"emocion": "amo",
					"TextoEmocion": "Lo amo"
				}, {
					"emocion": "molesto",
					"TextoEmocion": "Me molesta"
				}, {
					"emocion": "asusta",
					"TextoEmocion": "Me asusta"
				}, {
					"emocion": "divierte",
					"TextoEmocion": "Me divierte"
				}, {
					"emocion": "gusta",
					"TextoEmocion": "Me gusta"
				}, {
					"emocion": "triste",
					"TextoEmocion": "Me entristece"
				}, {
					"emocion": "asombro",
					"TextoEmocion": "Me asombra"
				}, {
					"emocion": "alegre",
					"TextoEmocion": "Me alegra"
				}],
				callback: function() {
					//callbackhere
				}
			};
			var opciones = $.extend({}, defaults, opciones);

			$(faceMocion).each(function(index) {
				var UnicoID = Date.now();
				$(this).attr("class", $(faceMocion).attr("class") + " " + UnicoID);
				var idTarget=$(this).data("id");
				var typeTarget=$(this).data("type");
				var EstadoInicial = "empty";
				var initTextEmocion = "<i class='fa fa-thumbs-up'></i> "+trad.ilike;
				var colorText="text-dark";
				if (typeof $(this).data("value") != "undefined" && $(this).data("value") != "") {
					EstadoInicial = $(this).data("value");
					$.each(opciones.emociones, function(index, emo) {
						if(EstadoInicial==emo.emocion){
							initTextEmocion=emo.TextoEmocion;
							EstadoInicial=emo.class;
							if(typeof emo.color != "undefined") colorText=emo.color;
						}
					});
				}/* else {
					$(this).val('alegre');
				}*/
				DescripcionFace = EstadoInicial;
				ElementoIniciar = '';
				ElementoIniciar = ElementoIniciar + '<div style="display:inline-block;"><div dato-descripcion="' + DescripcionFace + '" ';
				ElementoIniciar = ElementoIniciar + 'id-referencia="' + UnicoID;
				ElementoIniciar = ElementoIniciar + '" data-id="' + idTarget;
				ElementoIniciar = ElementoIniciar + '" data-type="' + typeTarget;
				ElementoIniciar = ElementoIniciar + '"  class="' + NombreSelector;
				ElementoIniciar = ElementoIniciar + ' selectorFace ' + EstadoInicial + '"></div>';
				ElementoIniciar = ElementoIniciar + '<span class="text-emotion bold '+colorText+'">'+initTextEmocion+'</span></div>';
				$(this).before(ElementoIniciar);
			});


			$(document).ready(function() {
				if($(".faceMocion").length < 1){
					BarraEmociones = '<div class="faceMocion">';
					$.each(opciones.emociones, function(index, emo) {
						barraClass = (typeof emo.class != "undefined") ? emo.class : emo.emocion;
						barraId = (typeof emo.class != "undefined") ? emo.class : emo.emocion;
						BarraEmociones = BarraEmociones + '<div dato-descripcion="' + emo.TextoEmocion;
						BarraEmociones = BarraEmociones +'" data-emocion="' + emo.emocion;
						BarraEmociones = BarraEmociones +'" data-descripcion="' + emo.TextoEmocion;
						if(emo.color != "undefined")
							BarraEmociones = BarraEmociones +'" data-color="' + emo.color;
						BarraEmociones = BarraEmociones + '" class="' + barraClass + '"></div>';
					});
					BarraEmociones = BarraEmociones + '</div>';
					$(document.body).append(BarraEmociones);
				}
				$(".faceMocion div").off().on("click", function() {
					SelectorEmocion.attr("class", NombreSelector + " selectorFace  " + $(this).attr('class'));
					removeClasses="letter-blue text-red letter-red text-purple text-brown text-azure text-orange letter-green text-red text-dark";
					SelectorEmocion.parent().find(".text-emotion").removeClass(removeClasses).addClass($(this).data('color')).html($(this).data('descripcion'));
					ElInputSeleccionado = SelectorEmocion.attr("id-referencia");
					$("." + ElInputSeleccionado).val($(this).attr('class'));

					if (typeof opciones.callback == "function") {
						opciones.callback(SelectorEmocion, $(this).data('emocion'));
					}


				});
				$('.faceMocion div').hover(function(){
						var title = $(this).attr('dato-descripcion');
						$(this).data('tipText', title).removeAttr('dato-descripcion');
						$('<p class="MensajeTexto"></p>').text(title).appendTo('body').fadeIn('slow');
				}, function() {
						$(this).attr('dato-descripcion', $(this).data('tipText'));
						$('.MensajeTexto').remove();
				}).mousemove(function(e) {
						var RatonX = e.pageX - 20;
						var RatonY = e.pageY - 60;
						$('.MensajeTexto').css({
							top: RatonY,
							left: RatonX
					})
				});
				
				
			});
			$('.' + NombreSelector+ ', .text-emotion').off().on("mouseenter",function(e) {
				SelectorEmocion = $(this).parent().find("."+ NombreSelector);
				xRate= ($(this).hasClass("text-emotion")) ? 20 : 20;
				yRate=($(this).hasClass("text-emotion")) ? 60 : 60;
				var RatonX = e.pageX - xRate;
				var RatonY = e.pageY - yRate;
				$(".faceMocion").css({
					top: RatonY,
					left: RatonX
				});
				$(".faceMocion").show();
			});
			$(document).mouseup(function(e) {
				$(".faceMocion").hide();
			});
			$(faceMocion).hide();

		}
	});
})(jQuery);