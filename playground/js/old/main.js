debug = true;

$(document).ready(function() {  
	
	window.User = Backbone.Model.extend({
		defaults : {
			id:'',
			name:'',
			email:'',
			city:'',
			country:'reunion',
			type:'citizen',
			isActor:'0',
			sponsored:'0',
			tags:[],
			avatar:'img/PHOTO_ANONYMOUS.png'
		},
		validate: function( attributes ){
			if( attributes.name === '') {
				return "Le nom est obligatoire !!!";
			}
			if( attributes.email === '') {
				return "Le mail est obligatoire !!!";
			}
			if( attributes.city === '') {
				return "La ville est obligatoire !!!";
			}
		},
		sync: function( method , model , options ){ 
			
			if( method === 'create' || method === 'update' )
			{

				return $.ajax({
					dataType : 'json',
					url: '/server/add.php',
					data:{
						id: (this.get('id') || ''),
						full_name: (this.get('full_name') || ''),
						email: (this.get('email') || ''),
						phone: (this.get('phone') || ''),
						address: (this.get('address') || '')
					},
					success: function( data ){
						$('span.false').html('');

						if( data.success === true){

							 if( method === 'update')
							 {
								App.router.navigate('list',{ trigger:true });
							 }
							 else 
							 {
								$('form').get(0).reset();
							 }
						}
						else 
						{
							$.each( data.validationError, function(){ 
								$('span.'+this.target).html(this.error);
								
							}); // end of each


						}

						$('span.success').html(data.msg).removeClass('false').addClass(data.success.toString());	
			
					}

				}); // end of ajax
			} // end of if
			else if ( method ==='delete' ){

				var id = this.get('id');

				return $.getJSON('http://127.0.0.1/play/nodeApplication/backbone-php-mysql/server/delete.php',
					{ id : id },
					function(data){ 

						if( data.success === true ){
							$('#contactTable tr[data-id="'+ id +'"]').hide('slow');
						}
						else
						{
							alert( data.msg );
						}

					}); // end of getJSON

			}
		}, // end of sync
		initialize : function User() {
			log('User Constructor');
			this.bind("error", function(model, error){
				log( error );
			});
		}
	});
		
	window.Users = Backbone.Collection.extend({
            model : User,
			localStorage : new Store("users"),
            initialize : function() {
                log('Users collection Constructor');
            }
        });
		
	window.UserView = Backbone.View.extend({
        el : $('#User-container'),
        initialize : function() {
            this.template = _.template($('#user-template').html());
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
		
	window.UsersCollectionView = Backbone.View.extend({
        el : $('#users-collection-container'),

        initialize : function() {
            this.template = _.template($('#users-collection-template').html());

            /*--- binding ---*/
            _.bindAll(this, 'render');
            this.collection.bind('change', this.render);
            this.collection.bind('add', this.render);
            this.collection.bind('remove', this.render);
            /*---------------*/

        },

        render : function() {
            var renderedContent = this.template({ users : this.collection.toJSON() });
            $(this.el).html(renderedContent);
            return this;
        }

    });
	
	window.UserFormView = Backbone.View.extend({
        el : $('#user-form-container'),

        initialize : function() {
            //Nothing to do now
        },
        events : {
            'submit form' : 'addUser'
        },
        addUser : function(e) {
            e.preventDefault();

            this.collection.add({
			/*id:'',
			name:'',
			email:'',
			city:'',
			country:'reunion',
			type:'citizen',
			isActor:'0',
			sponsored:'0',
			tags:[],
			avatar:'img/PHOTO_ANONYMOUS.png'*/
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
	
	window.UsersRouter = Backbone.Router.extend({

        initialize : function() {
            /* 1- Création d'une collection */
            this.users = new Users();
            /* 2- Chargement de la collection */
            this.users.fetch();

            /* 3- Création des vues + affichage */
            this.userFormView = new UserFormView({ collection : this.users });
            this.usersView = new UsersCollectionView({ collection : this.users });
            this.usersView.render();

            /* 4- Click sur un lien */
            this.route("user/:id", "user", function(id){
                log(id, this.users.get(id).toJSON());
            });
        },
		routes : {
            "" : "root",
            "about" : "about"
        },

        root : function() { log('Vous êtes à la racine');},
        about : function() { log('A propos : ceci est un tutorial BackBone');}

    });
	u1 = new User({id:'1',name:'Tibor Katelbach',email:'oceatoon@gmail.com',city:'La Ivere',country:'Reunion',type:'citizen',isActor:'1',tags:['developpeur','motivé','gentilVirus'],avatar:'img/PHOTO_TIBOR2.png'});
	u2 = new User({id:'2',name:'Stéphanie Lorente',email:'stephanie.lorente@gmail.com',city:'St Paul',country:'',type:'citizen',isActor:'0|1',sponsored:'',tags:['directrice artistique','motivé','gentilVirus'],avatar:'img/PHOTO_STEPHANIE.png'});
	u3 = new User({id:'3',name:'Sylvain Barbot',email:'sylvain.barbot@gmail.com',city:'3 Bassin',country:'',type:'citizen|company|association|',isActor:'1',tags:['developpeur','motivé','gentilVirus','artisan'],avatar:'img/PHOTO_ANONYMOUS.png'});
	users = new Users([u1,u2,u3]);
	u1.save();
	u2.save();
	u3.save();
	users = new Users();
	users.fetch();
	
	usersView = new UsersCollectionView({ collection : users });
	usersView.render();
	/*
	userFormView = new UserFormView({ collection : users });
    usersView = new UsersCollectionView({ collection : users });
    usersView.render();*/
	
	router = new UsersRouter();
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