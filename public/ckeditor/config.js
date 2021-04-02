/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];


	// Languages
	config.defaultLanguage = 'en';
	config.language = 'en';

	// Extra plugins
	config.extraPlugins = 'autosave';

	// Common settings
	config.toolbarCanCollapse = true;
	config.disableObjectResizing = false;
	config.uiColor = "var(--optional-color)";
	config.dialog_backgroundCoverOpacity = '0.5';
	config.allowedContent = true;

	// Autocorrect
	config.autocorrect_doubleQuotes = "«»";
	// config.autocorrect_singleQuotes = "„“„“„“„“„„„";
	config.autocorrect_dash = "—";
	config.disableNativeSpellChecker = false;

	// Autosave
	config.autosave = {
		messageType : "no",
		delay : 0,
		autoLoad: true,
		saveOnDestroy : true,
		// saveDetectionSelectors : "a[href^='javascript:__doPostBack'][id*='Save'],a[id*='Cancel']",
		saveDetectionSelectors : "input[type='submit']",
		removeStorageAfterAutoLoad: false,
	};

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

};