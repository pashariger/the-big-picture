<?php

/**
 * The Big Picture by Pasha Riger
 * 
 *
 *
 * @copyright     Copyright Pasha Riger 2013
 * @license 	  Open Source - free to copy, modify, redestribute
 * @version 	  0.1
 * @link          http://priger.com, @pashariger
 * @author 		  Pasha Riger
 * @since         TheBigPicture - 4/27/2013, Disrupt 2013
 */

//get current dir structure
$files = get_current_dir_structure();


//build connections
$link_structure = array();
foreach($files['mockups'] as $project_name => $project)
{
	foreach($project as $folder_name => $filename)
	{
		if(!is_integer($folder_name))
		{
			continue;
		}

		if(strstr($filename,'xxx_'))
		{
			continue;
		}


		$page_data = file_get_contents("mockups/$project_name/$filename");
		preg_match_all('~a href=("|\')(.*?)\1~', $page_data, $out);

		$cut_filename = str_replace('.html','',$filename);
		$cut_link = str_replace('.html','',$out[2]);

		foreach($cut_link as $key => $link){
			if($link == '#' || $link == '' || strstr($link, 'http') || strstr($link, '/') || $link == $cut_filename){
				unset($cut_link[$key]);
			}
		}

		$link_structure[$project_name][$cut_filename] = $cut_link;

	}
}



//if no project selected, print menu.
if(!isset($_GET['selected']))
{
 	require_once('/start.php');
}
else
{
	
	$mockup = $link_structure[$_GET['selected']];
	$mockup_folder = $_GET['selected'];

	//var_dump($mockup);
 	require_once('/draw.php');
}



function get_current_dir_structure()
{
	$ritit = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__), RecursiveIteratorIterator::CHILD_FIRST);
	$r = array();
	foreach ($ritit as $splFileInfo) {
	   $path = $splFileInfo->isDir()
	         ? array($splFileInfo->getFilename() => array())
	         : array($splFileInfo->getFilename());

	   for ($depth = $ritit->getDepth() - 1; $depth >= 0; $depth--) {
	       $path = array($ritit->getSubIterator($depth)->current()->getFilename() => $path);
	   }
	   $r = array_merge_recursive($r, $path);
	}

	return $r;
}
