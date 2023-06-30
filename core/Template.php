<?php

namespace app\core;

use app\core\Response;
/**
 * Class Template
 *
 * This is a template class file. Which can process and render templates for the layout view files.
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Template extends Response
{
	/**
	 * The value of view content
	 * Potential value will be string content
	 *
	 * @var string $viewContent
	 */
	protected static string $viewContent = "";

	/**
	 * The value of layout content
	 * Potential value will be string content
	 *
	 * @var string $layoutContent
	 */
	protected static string $layoutContent = "";

	/**
	 * The value of layout file path
	 * Potential value will be file path
	 *
	 * @var string $layoutFile
	 */
	protected static string $layoutFile = "";

	/**
	 * The value of layout parameters
	 * Potential value will be array of parameters
	 *
	 * @var array $layoutParams
	 */
	protected static array $layoutParams = [];
	
	/*
		Checking and validating for any layout exist.
		If exist then getting that details to initiate templace inheritance.
		Otherwise return same view as given before.
	*/
	function __construct($viewContent)
	{
		self::$viewContent = $viewContent;
	}

	/**
	 * Checking for @layout content in the content
	 *
	 * @param string content $content this must be a valid string content	 
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 */
	protected function isLayoutExist($content)
	{
		/*
			Checking for empty content
		*/
		if (empty(trim($content))) {
			return false;
		}

		/*
			Checking for any layout exist otherwise return view only
	 	*/
		if (strpos($content, '@layout') === false) {
			return false;
		}

		/*
			Regex match for the @layout structure presents in the view content
		*/
		preg_match('/^@(layout)\((.*?)\)/', $content, $matches);
		
		/* 
			This will checks for exactly present in the line or not 
		*/
		$pos = strpos($matches[0], "@layout");

		/* 
			If it may be incorrect form of @layout('layout', [params]) structure return view only 
		*/
		if($pos === false) {
			return false;
		}

		return true;
	}

	/**
	 * Getting layout details
	 *	 	 
	 * @author ag-sanjjeev <resulttext>
	 */
	protected function getLayoutDetails()
	{
		$content = self::$viewContent;

		/*
			Regex match for the @layout structure presents in the view content
		*/
		preg_match('/^@(layout)\((.*?)\)/', $content, $matches);
		
		/* 
			This will checks for exactly present in the line or not 
		*/
		$pos = strpos($matches[0], "@layout");

		/* 
			Removes the line from the file after getting layout details 
		*/
		$content = str_replace($matches[0], '', $content);

		/*
			Reflecting layout content after removing layout details
		*/
		self::$viewContent = $content;

		/*
			Getting layout details	
		*/		
		$layout =  substr($matches[0], $pos + 1);
		
		/*
			Extracting layout details such as layout file path and it's params
		*/
		preg_match('/\((.*?)\)/', $layout, $matches);
		
		/*
			Extracting layout filename once it got pop out from layoutDetailsArray
		*/
		$layoutDetailsArray = explode(',', $matches[1]);
		$layoutFile = $layoutDetailsArray[0];
		$layoutDetailsArray = array_reverse($layoutDetailsArray);
		array_pop($layoutDetailsArray);

		/*
			Extracting params if it presents
		*/		
		$layoutDetailsArray = array_reverse($layoutDetailsArray);
		$paramsArrayString = implode(',', $layoutDetailsArray);
		$paramsArrayString = trim($paramsArrayString);
		$paramsArray = [];

		/* Evaluating string into a variable */
		eval("\$layoutFile = $layoutFile;");
		
		/* If paramArrayString is an empty doesn't evaluated */
		if(!empty($paramsArrayString)) {
			eval("\$paramsArray = $paramsArrayString;");
		}

		/* If paramsArray is not in the form array it doesn't evaluated */
		if (!is_array($paramsArray)) {
			$paramsArray = [];
		}

		self::$layoutFile = $layoutFile;
		self::$layoutParams = $paramsArray;
	}

	/**
	 * Renders the layoutfile as it is
	 *
	 * @param file path $layoutFile this must be a valid layout file location inside views/layouts directory
	 * @param parameters $params this must be array values to used inside that layout and view
	 * @author ag-sanjjeev <resulttext>
	 * @return layout content
	 */
	protected function layout($layoutFile, $params = [])
	{
		$layoutFile = str_replace('.', '/', $layoutFile);
		$layoutFile = trim($layoutFile, '\'"');

	 	return $this->renderOnlyView($layoutFile, $params);
	}

	/**
	 * Checking for any section exist
	 *	 
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 */
	protected function isSectionExist()
	{
		if (strpos(self::$viewContent, '@section(') === false) {
			return false;
		} 

		return true;
	}
	
	/**
	 * Injecting array of sections into the @yield directives in the template content
	 *
	 * @param section names $sections this must be an array of sections name
	 * @param section contents $sectionContent this must be an array of section content
	 * @param template content $template this must be a template content
	 * @author ag-sanjjeev <resulttext>
	 * @return template
	 */
	protected function injectSectionIntoYield($sections = [], $sectionContent, $template)
	{
		foreach ($sections as $key => $value) {			
			$template = preg_replace('/@yield\(\''.$value.'\'\)/', $sectionContent[$value][0], $template);
		}
		return $template;
	}

	/**
	 * Filter to get available section name in the layout @yields
	 *
	 * @param template content $template this must be a template content
	 * @author ag-sanjjeev <resulttext>
	 * @return array of section names
	 */
	protected function filterSections($template)
	{
		preg_match_all('/@yield\(\'(.*?)\'\)/', $template, $matches);		
		return $matches[1];
	}

	/**
	 * Extracting content inside @section @endsection directives and 
	 * Seperating non-sectioned content
	 *
	 * @param section names $sections this must be an array of section names
	 * @param view content $viewContent this must be a view content
	 * @author ag-sanjjeev <resulttext>
	 * @return array of sectionContent and viewContent
	 */
	protected function extractSections($sectionNames = [], $viewContent)
	{
		/* 
			Creating an empty array for sectioned content
		*/
		$sectionContent = [];

		/*
			Iterate through all section available in the viewContent if not matched that will be treated as non-sectioned content
		*/
		foreach ($sectionNames as $key => $value) {

			/*
				Extracts matched @section..@endsection content from viewContent
			*/
			preg_match_all('/@section\(\''.$value.'\'\)(.*?)@endsection/s', $viewContent, $matches);
			
			/*
				Assigns into $sectionContent
			*/
			$sectionContent[$value] = $matches[1];			

			/*
				Eliminating or Emptying the extracted section content and thus all remaining content treated as non-sectioned content
			*/
			$viewContent = preg_replace('/@section\(\''.$value.'\'\)(.*?)@endsection/s', '', $viewContent);	

		}

		/*
			Assigned as an associative array
		*/
		$data = array(
					'sectionContent' => $sectionContent, 
					'nonSectionedContent' => $viewContent
				);

		return $data;
	}	

	/**
	 * Appending non-sectioned contents into the template content
	 * 
	 * @param template content $template this must be a template content
	 * @param non-section content $newViewContent this must be a non-section content
	 * @author ag-sanjjeev <resulttext>
	 * @return template content
	 */
	protected function appendRemainingContent($template, $nonSectionedContent)
	{

		/*
			Regex pattern for extracting all content inside body tag
		*/
		$pattern = "/<body(.*?)>(.*?)<\/body>/is";

		/*
			Matches for body tag pattern with $template
		*/
		preg_match($pattern, $template, $matches);

		/*
			If matche is not found then throughs an exception
		*/
		if (count($matches) > 0) {
			/*
				Getting body content into $bodyContent
			*/
			$bodyContent = $matches[2];

			/*
				Regex pattern for extracting all script tags from $bodyContent
			*/
			$scriptPattern = "/<script.*?<\/script>/is";

			/*
				Matches for all script tag pattern with $bodyContent
			*/
			preg_match_all($scriptPattern, $bodyContent, $scriptTags);

			/*
				If script tag founds then arrage all script tags at bottom of body tag and appending non-section content above that scripts
			*/
			if (count($scriptTags[0]) > 0) {

				/*
					Getting extracted script tags array as string
				*/
				$extractedScripts = implode("\n", $scriptTags[0]);
				
				/*
					Eliminating or emptying script tags from bodyContent
				*/
				$bodyContent = preg_replace($scriptPattern, '', $bodyContent);

				/*
					Preparing for appending non-section content and arranging unordered script tags to the bottom of the body
				*/
				$newContent = $bodyContent;
				$newContent .= $nonSectionedContent;
				$newContent .= $extractedScripts;

				/*
					Replaces bodyContent with new Content
				*/
				$newContent = str_replace($bodyContent, $newContent, $bodyContent);

				/*
					Adding opening and closing body tag to the newContent due to regex replace
				*/
				$pattern = "/(<body.*?>)(.*?)(<\/body>)/is";
				$replacement = "$1" . $newContent . "$3";
				$newContent = preg_replace($pattern, $replacement, $template);

				return $newContent;

			} else {
				
				/*
					Preparing for appending non-section content. when no script tag present in the view to the bottom of the body
				*/
				$newContent = $bodyContent;
				$newContent .= $nonSectionedContent;

				/*
					Replaces bodyContent with new Content
				*/
				$newContent = str_replace($bodyContent, $newContent, $bodyContent);

				/*
					Adding opening and closing body tag to the newContent due to regex replace
				*/
				$pattern = "/(<body.*?>)(.*?)(<\/body>)/is";
				$replacement = "$1" . $newContent . "$3";
				$newContent = preg_replace($pattern, $replacement, $template);

				return $newContent;

			} 

		} else {
			throw new \Exception("No Body tag found.", 1);
			exit();
		}
	}

	/**
	 * Renders the layout
	 *	 
	 * @author ag-sanjjeev <resulttext>
	 * @return rendered view content
	 */
	public function render()
	{
		/*
			This will checking for any layout exist in the given content
			Otherwise it will return that view content as it given.
		*/
		if (!$this->isLayoutExist(self::$viewContent)) {
			return self::$viewContent;
		}

		/*
			Getting layout details to store in the static property to use it
		*/
		$this->getLayoutDetails();

		/*
			Rendering layout content from extracted layout file path by parent class method
		*/
		self::$layoutContent = $this->layout(self::$layoutFile, self::$layoutParams);

		/*
			Checking for any section directives exist in the view content
		*/
		if (!$this->isSectionExist()) {
			// replace inbetween body tag
		}

		/* 
			Assign layout content into $template
		*/
		$template = self::$layoutContent;

		/*
			Assign view content into $viewContent
		*/
		$viewContent = self::$viewContent;

		/*
			Filters the @yield sections names from template
		*/
		$sectionNames = $this->filterSections($template);

		/*
			Separates the section content and non-sectioned content from view content
		*/
		$data = $this->extractSections($sectionNames, $viewContent);
		
		/*
			Assigning section content to $sectionContent
		*/
		$sectionContent = $data['sectionContent'] ?? '';

		/*
			Assigning non-sectioned content to $nonSectionedContent
		*/
		$nonSectionedContent = $data['nonSectionedContent'] ?? '';

		/*
			Injecting sectioned content into the layout
		*/
		$template = $this->injectSectionIntoYield($sectionNames, $sectionContent, $template);

		/*
			Injecting non-sectioned content into the layout
		*/
		$template = $this->appendRemainingContent($template, $nonSectionedContent);
				
		return $template;

	}
	
}