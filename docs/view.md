## Template Usage

	To create consistent and reusable views in your application, you can use templates. Templates allow you to define a common layout and include dynamic content within specific sections.

### Layout

	For example the layout file `layouts/main.php` is used as the base template for all pages. It includes the main CSS file `main.css` and defines the overall structure of the page.

```php
	@layout('layouts.main', ['title' => 'Test: page'])
```
	
	The `@layout` directive is used to specify the layout file to be used and can also pass additional data, such as the title.


### CSS Link

	To include a CSS file in the layout, you can use the `@section` directive. In this example, the `main.css` file is linked using the `@section('links')` directive.

```php
	@section('links')

		<link rel="stylesheet" type="text/css" href="./styles/main.css" media="all" />

		<style>
			body {
				background-color: #fff;
			}
		</style>
	@endsection
```

### Script Sourcing

	To include a Script file in the layout, you can use the `@section` directive. In this example, the `main.js` file is linked using the `@section('scripts')` directive.

```php
	@section('scripts')
		<script src="./scripts/main.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			console.log('Application initiated');
		</script>
	@endsection
```

### Content Sections

You can define content sections within the layout file using the `@section` directive. These sections can be filled with dynamic content from the views.

```php
	@section('content')


    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    
    ...

	@endsection
```

In the example above, the `@section('content')` directive creates a content section that can be filled with content in the views.

### Include Additional Content

You can also include additional content sections within the layout file. In this example, the `@section('footer')` directive is used.

```php
	@section('header')
	    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	@endsection

	@section('footer')
	    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	@endsection
```

### View Content

	Within the views, you can extend the layout and fill the content sections with specific content. Here's an example view file `subdirectory/home.php`:

```php
	@layout('layouts.main')

	@section('content')		    

        this is sample content
    
        ...		  

	@endsection

	@section('content2')
	    ...
	@endsection

	<?php echo $text; ?>
```

In the view file, the `@layout` directive is used to extend the `layouts/main` layout. The `@section` directives are used to fill the content sections with specific content.

And use can use php code directly with or without layout

By using templates, you can maintain a consistent layout across your application and easily reuse and modify views.

This documentation provides an explanation of how to use templates in the application, including defining the layout, linking CSS files, sourcing Script files, creating content sections, including additional content such as header and footer, and using views to fill the content sections.