/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.editorplaceholder = 'Nội dung bài viết';
	config.skin = 'office2013';
	config.filebrowserBrowseUrl = 'http://localhost/dichvu/styles/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'http://localhost/dichvu/styles/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'http://localhost/dichvu/styles/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'http://localhost/dichvu/styles/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'http://localhost/dichvu/styles/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://localhost/dichvu/styles/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
