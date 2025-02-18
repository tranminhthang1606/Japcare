﻿/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 * */

CKEDITOR.editorConfig = function( config ) {

    config.language = 'vi';

    config.filebrowserBrowseUrl = '/ckeditor/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/ckeditor/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/ckeditor/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
