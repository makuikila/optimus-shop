(function($){
    $(document).ready(function () {
        var $img = $('.carrousel img'), // on cible les images contenues dans le carrousel
            indexImg = $img.length - 1, // on définit l'index du dernier élément
            i = 0, // on initialise un compteur
            $currentImg = $img.eq(i); // enfin, on cible l'image courante,qui possède l'index i (0 pour l'instant)
        $img.css({// on cache les images
            opacity: '0',
    
        }); 
        $currentImg.css({// on affiche seulement l'image courante
            opacity: '1',
            transition: '2s'
            
        }); 
        $('#suivant').click(function () { // image suivante
            i++; // on incrémente le compteur
            if (i <= indexImg) {
                $img.css({
                    opacity: '0',
                    transition: '2s'
                }); // on cache les images
                $currentImg = $img.eq(i);// on définit la nouvelle image
                $currentImg.css({
                    opacity: '1'
                }); // on affiche seulement l'image courante
            }
            else {
                i = indexImg;
            }
        });
        $('#precedent').click(function () { // image précédente
            i--; // on décrémente le compteur, puis on réalise la même chose que pour la fonction "suivante"
            if (i >= 0) {
                $img.css({
                    opacity: '0',
                    transition: '2s'
                }); // on cache les images
                $currentImg = $img.eq(i);// on définit la nouvelle image
                $currentImg.css({
                    opacity: '1'
                }); // on affiche seulement l'image courante
            }
            else {
                i = 0;
            }
        });
        function slideImg() {
            setTimeout(function () { // on utilise une fonction anonyme
                if (i < indexImg) { // si le compteur est inférieur au dernier index
                    i++; // on l'incrémente
                }
                else { // sinon, on le remet à 0 (première image)
                    i = 0;
                }
                $img.css({
                    opacity: '0',
                    transition: '2s'
                }); // on cache les images
                $currentImg = $img.eq(i);// on définit la nouvelle image
                $currentImg.css({
                    opacity: '1'
                }); // on affiche seulement l'image courante
                slideImg(); // on oublie pas de relancer la fonction à la fin
            }, 7000); // on définit l'intervalle à 7000 millisecondes (5s)
            
        }
        slideImg(); // enfin, on lance la fonction une première fois
    });
   
})(jQuery);
