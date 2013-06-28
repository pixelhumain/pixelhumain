debug = true;

$(document).ready(function() {  
	
	window.Doc = Backbone.Model.extend({

		defaults : {
			id : "???",
			title : "Doc Title",
			text : "Bla bla bla",
			keywords : "word1, word2, word3, ..."
		},
		validate: function( attributes ){
			if( attributes.title === '') {
				return "Le titre du document ne peut pas être vide !!!";
			}
		},
		initialize : function Doc() {
			log('Doc Constructor');
			this.bind("error", function(model, error){
				log( error );
			});
		}
	});
		
	window.Docs = Backbone.Collection.extend({
            model : Doc,
			localStorage : new Store("docs"),
            initialize : function() {
                log('Docs collection Constructor');
            }
        });
		
	window.DocView = Backbone.View.extend({
        el : $('#doc-container'),
        initialize : function() {
            this.template = _.template($('#doc-template').html());
			/*--- binding ---*/
            _.bindAll(this, 'render');
            this.model.bind('change', this.render);
            /*---------------*/
        },

        render : function() {
            var renderedContent = this.template(this.model.toJSON());
            $(this.el).html(renderedContent);
            return this;
        }

		});
		
	window.DocsCollectionView = Backbone.View.extend({
        el : $('#docs-collection-container'),

        initialize : function() {
            this.template = _.template($('#docs-collection-template').html());

            /*--- binding ---*/
            _.bindAll(this, 'render');
            this.collection.bind('change', this.render);
            this.collection.bind('add', this.render);
            this.collection.bind('remove', this.render);
            /*---------------*/

        },

        render : function() {
            var renderedContent = this.template({ docs : this.collection.toJSON() });
            $(this.el).html(renderedContent);
            return this;
        }

    });
	
	window.DocFormView = Backbone.View.extend({
        el : $('#doc-form-container'),

        initialize : function() {
            //Nothing to do now
        },
        events : {
            'submit form' : 'addDoc'
        },
        addDoc : function(e) {
            e.preventDefault();

            this.collection.add({
                id : this.$('.id').val(),
                title : this.$('.title').val(),
                text : this.$('.text').val(),
                keywords : this.$('.keywords').val()
            }, { error : _.bind(this.error, this) });
			this.collection.get(this.$('.id').val()).save();
            this.$('input[type="text"]').val(''); //on vide le form
        },
        error : function(model, error) {
            log(model, error);
            return this;
        }

    });
	
	window.DocsRouter = Backbone.Router.extend({

        initialize : function() {
            /* 1- Création d'une collection */
            this.docs = new Docs();
            /* 2- Chargement de la collection */
            this.docs.fetch();

            /* 3- Création des vues + affichage */
            this.docFormView = new DocFormView({ collection : this.docs });
            this.docsView = new DocsCollectionView({ collection : this.docs });
            this.docsView.render();

            /* 4- Click sur un lien */
            this.route("doc/:id", "doc", function(id){
                console.log(id, this.docs.get(id).toJSON());
            });
        },
		routes : {
            "" : "root",
            "about" : "about"
        },

        root : function() { console.log('Vous êtes à la racine');},
        about : function() { console.log('A propos : ceci est un tutorial BackBone');}

    });
	d1 = new Doc();
	d2 = new Doc({ id : '001', title : 'Mon 1er doc', text : 'Hello world', keywords : 'hello, world'});
	d3 = new Doc({ id : '002', title : 'Mon 1er doc', text : 'Hello world', keywords : 'hello, world'});
	docs = new Docs([d1,d2,d3]);
	/*d1.save();
	d2.save();
	d3.save();*/
	docs = new Docs();
	docs.fetch();
	
	docView = new DocView({ model : docs.get('???') });
	docView.render();
	docsView = new DocsCollectionView({ collection : docs });
	docsView.render();
	
	ocFormView = new DocFormView({ collection : docs });
    docsView = new DocsCollectionView({ collection : docs });
    docsView.render();
	
	router = new DocsRouter();
	Backbone.history.start();
	
});
function log(msg,type){
	if(debug){
	   try {
	    if(type){
	      switch(type){
	        case 'info': console.info(msg); break;
	        case 'warn': console.warn(msg); break;
	        case 'debug': console.debug(msg); break;
	        case 'error': console.error(msg); break;
	        case 'dir': console.dir(msg); break;
	        default : console.log(msg);
	      }
	    } else
	          console.log(msg);
	  } catch (e) { 
	     //alert(msg);
	  }
	}
}