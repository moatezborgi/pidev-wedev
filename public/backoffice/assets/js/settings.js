(function($) {
  'use strict';
  $(function() {
    $(".nav-settings").click(function() {
      $("#right-sidebar").toggleClass("open");
    });
    $(".settings-close").click(function() {
      $("#right-sidebar,#theme-settings").removeClass("open");
    });

    $("#settings-trigger").on("click", function() {
      $("#theme-settings").toggleClass("open");
    });


    //background constants
    var navbar_classes = "navbar-danger navbar-success navbar-warning navbar-dark navbar-light navbar-primary navbar-info navbar-pink";
    var sidebar_classes = "sidebar-light sidebar-dark";
    var $body = $("body");

    //sidebar backgrounds
    $("#sidebar-default-theme").on("click", function() {
      $body.removeClass(sidebar_classes);
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
    });
    $("#sidebar-dark-theme").on("click", function() {
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-dark");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
    });


    //Navbar Backgrounds
    $(".tiles.primary").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-primary");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.success").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-success");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.warning").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-warning");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.danger").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-danger");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.info").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-info");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.dark").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-dark");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.default").on("click", function() {
      $(".navbar").removeClass(navbar_classes);
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });

    //Horizontal menu in mobile
    $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
      $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
    });
    // Horizontal menu navigation in mobile menu on click
    var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
    navItemClicked.on("click", function(event) {
      if(window.matchMedia('(max-width: 991px)').matches) {
        if(!($(this).hasClass('show-submenu'))) {
          navItemClicked.removeClass('show-submenu');
        }
        $(this).toggleClass('show-submenu');
      }        
    });

    $(window).scroll(function() {
      if(window.matchMedia('(min-width: 992px)').matches) {
        var header = $('.horizontal-menu');
        if ($(window).scrollTop() >= 71) {
          $(header).addClass('fixed-on-scroll');
        } else {
          $(header).removeClass('fixed-on-scroll');
        }
      }
    });

  });
})(jQuery);
/*$(function () {
  // Multiple images preview with JavaScript
  var multiImgPreview = function (input, imgPreviewPlaceholder) {
    if (input.files) {
      var filesAmount = input.files.length;
      for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();
        reader.onload = function (event) {
          $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                      
        }
        reader.readAsDataURL(input.files[i]);
      }
    }
  };
  $('#hotel_image').on('change', function () {
    multiImgPreview(this, 'div.imgGallery');
  });
});*/
var abc = 0; //Declaring and defining global increement variable

 

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
       
        $(this).before($("<div/>", {id: 'filediv'}).append(
                $("<input/>", {name: 'hotel[image][]', type: 'file', id: 'hotel_image'}),        
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file	
$('body').on('change', '#hotel_image', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img style='padding:8px;max-width:100px;' id='previewimg" + abc + "' src=''/></div>");
           
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'assets/images/x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };


     // Gestion des boutons "Supprimer"
     let links = document.querySelectorAll("[data-delete]")
    
     // On boucle sur links
     for(link of links){
         // On écoute le clic
         link.addEventListener("click", function(e){
             // On empêche la navigation
             e.preventDefault()
 
             // On demande confirmation
             if(confirm("Voulez-vous supprimer cette image ?")){
                 // On envoie une requête Ajax vers le href du lien avec la méthode DELETE
                 fetch(this.getAttribute("href"), {
                     method: "DELETE",
                     headers: {
                         "X-Requested-With": "XMLHttpRequest",
                         "Content-Type": "application/json"
                     },
                     body: JSON.stringify({"_token": this.dataset.token})
                 }).then(
                     // On récupère la réponse en JSON
                     response => response.json()
                 ).then(data => {
                     if(data.success)
                         this.parentElement.remove()
                     else
                         alert(data.error)
                 }).catch(e => alert(e))
             }
         })
     }


 

        $('#add_more_chambre').click(function() {
       
          $(this).before($("<div/>", {id: 'filediv'}).append(
                  $("<input/>", {name: 'chambre[image][]', type: 'file', id: 'chambre_image'}),        
                  $("<br/><br/>")
                  ));
      });
 

      //---------------------------------//
      $('body').on('change', '#chambre_image', function(){
        if (this.files && this.files[0]) {
             abc += 1; //increementing global variable by 1
    
    var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd"+ abc +"' class='abcd'><img style='padding:8px;max-width:100px;' id='previewimg" + abc + "' src=''/></div>");
       
      var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
           
      $(this).hide();
            $("#abcd"+ abc).append($("<img/>", {id: 'img', src: '../assets/images/x.png', alt: 'delete'}).click(function() {
            $(this).parent().parent().remove();
            }));
        }
    });

 

    $('#add_more_offre').click(function() {
       
      $(this).before($("<div/>", {id: 'filediv'}).append(
              $("<input/>", {name: 'offrevoyage[image][]', type: 'file', id: 'offrevoyage_image'}),        
              $("<br/><br/>")
              ));
  });
      //---------------------------------//
      $('body').on('change', '#offrevoyage_image', function(){
        if (this.files && this.files[0]) {
             abc += 1; //increementing global variable by 1
    
    var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd"+ abc +"' class='abcd'><img style='padding:8px;max-width:100px;' id='previewimg" + abc + "' src=''/></div>");
       
      var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
           
      $(this).hide();
            $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'assets/images/x.png', alt: 'delete'}).click(function() {
            $(this).parent().parent().remove();
            }));
        }
    });


    

 