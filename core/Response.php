<?php

namespace app\core;

use app\core\Template;
/**
 * Class Response
 *
 * This is a response class file. Which has all reponse related features and functionalities.
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Response
{
	/**
	 * The value of response status code
	 * Potential values are 200, 404, 500, etc.,
	 * 
	 * @var string $statusCode
	 */
	public static int $statusCode = 200;

	/**
	 * The typed property value of Response class
	 * Potential value will be object of the class
	 *
	 * @var Response $response
	 */
	public static Response $response;

	/**
	 * Initiating entry point for response
	 *	 
	 * @author ag-sanjjeev <resulttext>	 
	 *
	 */
	function __construct()
	{
		self::$response = $this;		
	}

	/**
	 * Sets the http response code
	 *
	 * @param http response code $code this must be a valid http response code	 
	 *
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function setStatusCode($code)
	{
		if (empty($code)) {
			throw new \Exception("The valid response code is not given", 1);
			exit();
		}

		self::$statusCode = $code;

		http_response_code(self::$statusCode);
	}

	/**
	 * Sets the content type of the page
	 *
	 * @param content-type $contentType this must be a valid content type	 
	 *
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function setContentType($contentType)
	{
		if (empty($contentType)) {
			throw new \Exception("The valid content-type is not given", 1);
			exit();
		}

		header("Content-Type:$contentType");
	}

	/**
	 * Redirect the current page to given url path
	 *
	 * @param url path $urlPath this must be a valid url path	 
	 *
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function redirect($urlPath)
	{
		if (empty($urlPath)) {
			throw new \Exception("Redirecting url path is not given", 1);
			exit();
		}

		header("Location: $urlPath");
		exit();
	}

	/**
	 * Renders given content as it is
	 *
	 * @param text/html content $content this must be a text/html content	 	 
	 * @author ag-sanjjeev <resulttext>
	 * 
	 */
	public function renderContent($content)
	{
		echo $content;
	}

	/**
	 * Renders view file only from views
	 *
	 * @param file path $viewFile this must be a valid view file location inside views directory
	 * @param parameters $params this must be array values to used inside that view
	 * @author ag-sanjjeev <resulttext>
	 * @return view content only
	 */
	public function renderOnlyView($viewFile, $params = [])
	{
	 	/*
			Converts $params array into seperate variables
	 	*/
	 	foreach ($params as $key => $value) {
	 		$var = $key;

	 		/*
				if any white spaces in between key name and it replaces with underscore
	 		*/
	 		if (strpos($var, " ") !== false) {
		 		$var = implode("_", explode(" ", $var));
	 		}

	 		$$var = $value;
	 	}

	 	/*
			This will holds viewFile path
	 	*/
	 	$viewFilePath = Application::$ROOT_DIR . "/public/views/$viewFile.php";

	 	/*
			if view file is not exist from views directory then it renders as plain text
	 	*/
	 	if (!file_exists($viewFilePath)) {
	 		return $this->renderContent($viewFile);
	 	}
	 	
	 	/*
			Includes viewfile as given
	 	*/
	 	ob_start();
	 	include_once $viewFilePath;
	 	return ob_get_clean();
	}

	/**
	 * Renders view
	 *
	 * @param file path $viewFile this must be a valid view file location inside views directory
	 * @param parameters $params this must be array values to used inside that view
	 * @author ag-sanjjeev <resulttext>
	 * @return processed view content
	 */
	public function view($viewFile, $params = [])
	{		 	
		/*
			Getting view content from view file path
		*/
		$viewContent = $this->renderOnlyView($viewFile, $params);

		/*
			Rendering template if exist otherwise simply renders view
		*/
	 	$template = new Template($viewContent);
	 	return $template->render();
	}	
	
}