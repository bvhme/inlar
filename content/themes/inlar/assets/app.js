"use strict";function png_or_svg(){return Modernizr.svgasimg?".svg":".png"}!function(n){Modernizr.svgasimg&&n("img.png2svg").attr("src",function(){return n(this).removeClass("png2svg").attr("src").replace(".png",".svg")})}(jQuery),jQuery(window).load(function(){var n=new maputils,o=function(o){var e=jQuery(this).data("country");o.preventDefault(),n.add_markers(mapconfig.ngos,e),n.enable_map()};n.baselayer=L.tileLayer(mapconfig.template.nolabels,{attribution:mapconfig.attribution,subdomains:"abcd",maxZoom:19}),n.map=L.map("map",{center:mapconfig.center,scrollWheelZoom:!1,layers:[n.baselayer],zoom:4}),jQuery(".countries a",".map-container").on("click",o),jQuery("#country-control").on("click",".dropdown a",o)}),function(n){var o={ngos:"/json/ngos/",countries:"/json/countries/"};n.each(o,function(o,e){n.getJSON(e,function(n){window.mapconfig[o]=n.data})})}(jQuery),function(n){n(document).on("click",".dropdown-container",function(o){n(this).addClass("open")}).on("click",function(o){n(o.target).closest(".dropdown-container").length||n(".dropdown-container").removeClass("open")})}(jQuery);
//# sourceMappingURL=app.js.map
