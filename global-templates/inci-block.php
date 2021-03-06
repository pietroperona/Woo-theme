<?php
/**
 * Inci Block setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>



<?php if( get_field('inci_block') ): ?>

    <div class="continer container-inci">
        <h2 class="inci-title">Ingredienti principali</h2>
    <div class="row inci-row">
            <div class="col-md-6 col-inci">
                <div class="inci-tit-sec-box">
                    <h4 class="inci-title-sec">Fragranza</h4>
                    <svg version="1.1" class="center-block" id="subline-inci" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1906.5 11.2" style="enable-background:new 0 0 1906.5 11.2;" xml:space="preserve">
                    <g>
                        <g id="Layer_1-2">
                            <polygon points="952,11.2 1854.9,11.2 1906.5,5.8 1854.7,0 952,0 		"/>
                            <polygon points="954.4,11.2 51.6,11.2 0,5.8 51.8,0 954.4,0 		"/>
                        </g>
                    </g>
                    </svg>	
                </div>
                <div class="row">
                <div class="col-md-6">
                <img class="text-center inci-svg center-block" src="<?php the_field('inci_illu_1'); ?>" />
                <h3 class="inci-svg-title"><?php the_field('inci_illu_tit_1'); ?></h3>                </div>
                <div class="col-md-6">
                <img class="text-center inci-svg center-block" src="<?php the_field('inci_illu_2'); ?>" />
                <h3 class="inci-svg-title"><?php the_field('inci_illu_tit_2'); ?></h3>                </div>
                </div>
            </div>
                <div class="col-md-6 col-inci">
                <div class="inci-tit-sec-box">
                    <h4 class="inci-title-sec">Base Sapone</h4>
                    <svg version="1.1" class="center-block" id="subline-inci" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1906.5 11.2" style="enable-background:new 0 0 1906.5 11.2;" xml:space="preserve">
                    <g>
                        <g id="Layer_1-2">
                            <polygon points="952,11.2 1854.9,11.2 1906.5,5.8 1854.7,0 952,0 		"/>
                            <polygon points="954.4,11.2 51.6,11.2 0,5.8 51.8,0 954.4,0 		"/>
                        </g>
                    </g>
                    </svg>	
                </div>
                <div class="row">
                <div class="col-md-6">
                <img class="text-center inci-svg center-block" src="<?php the_field('inci_illu_3'); ?>" />
                <h3 class="inci-svg-title"><?php the_field('inci_illu_tit_3'); ?></h3>
                </div>
                <div class="col-md-6">
                <img class="text-center inci-svg center-block" src="<?php the_field('inci_illu_4'); ?>" />
                <h3 class="inci-svg-title"><?php the_field('inci_illu_tit_4'); ?></h3>                </div>
                </div>
            </div>
    </div>
</div>
	
<?php endif; ?>