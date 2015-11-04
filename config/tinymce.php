<?php

return [

	'cdn' => env('APP_URL') .':8000/vendor/js/tinymce/tinymce.min.js',

	'params' => [
		
		"image_prepend_url"=>env('APP_URL').":8000/photos/icon_size/",
		"image_list"=> env('APP_URL').":8000/admin/media/list",
		
		"selector" => "#tinymce",
		"language" => 'fr_FR',
		"theme" => "modern",
		"skin" => "lightgray",
		// "plugins" => [
	 //         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	 //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	 //         "save table contextmenu directionality emoticons template paste textcolor"
		// ],
		// "plugins" => [
	 //          " link image lists charmap  preview hr anchor pagebreak spellchecker",
	 //          " wordcount visualblocks  code fullscreen insertdatetime  nonbreaking",
	 //          " table contextmenu directionality  template paste textcolor"
		// ],
		"toolbar" => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
	]

];