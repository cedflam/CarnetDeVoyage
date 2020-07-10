$(document).ready(function(){

    let image = $('.deleteImage');

   image.on('click', function (e) {
       e.preventDefault();
       const url = $(this).attr('href');
       const id = $(this).data('target');

       if (confirm("Voulez-vous supprimer cette image ?")) {
           //Je supprime l'image
           $('.image' + id).remove();

           axios.delete(url).then(response => {
               toast("Image supprimée", "linear-gradient(to right, #00b09b, #96c93d)");
           }).catch(error => toast("Une erreur s'est produite", "red"));
       }
    })
})
