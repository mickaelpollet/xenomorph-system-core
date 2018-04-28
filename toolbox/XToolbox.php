<?php
/*************************************
 * @project: 	Xenomorph - System - Tools
 * @file:		Globals fonctions page
 * @author: 	Mickaël POLLET
 *************************************/

/*****************     SYSTEM     *****************/
// Fonction de suppression de l'arbre de répertoires
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

// Vérifie si une chaîne est en JSON ou non
function is_json($string) {
	return ((is_string($string) &&
			(is_object(json_decode($string)) ||
			is_array(json_decode($string))))) ? true : false;
}

// Vérifie si une valeur se trouve dans un tableau ou non
function inArray($search, $array) {
	foreach ($array as $array_key => $array_value) {
		if (is_array($array_value)) {
			if (inArray($search, $array_value)) {
				return true;
			}
		} else {
			if ($array_key === $search || $array_value === $search) {
				return true;
			}
		}
	}
	return false;
}

// Récupération de la branche GIT courante
function gitBranch() {
	$currentHead = file(__DIR__.'/../.git/HEAD', FILE_USE_INCLUDE_PATH);
	$currentHeadLine = $currentHead[0];
	$branchString = explode("/", $currentHeadLine, 3);
	$branchName = $branchString[2];
	return trim($branchName);
}
/*****************     FIN SYSTEM     *****************/

/*****************     AFFICHAGE SITE     *****************/
// Affiche une icône Bootstrap en fonction de son nom
function showGlyph($glyph_name, $type = 'glyphicons', $color = '', $params = '') {

	$type_possibilities = array('halflings', 'glyphicons', 'filetypes', 'social');

	if (!in_array($type, $type_possibilities)) {	throw new XException('00010001', 4, array( 0 => $type )); }

	if (empty($color)) {
		if (!empty($params)) {
			return '<span class=\''.$type.' '.$type.'-'.$glyph_name.'\' style=\''.$params.'\'></span>';
		} else {
			return '<span class=\''.$type.' '.$type.'-'.$glyph_name.'\'></span>';
		}
	} else {
		if (!empty($params)) {
			return '<span class=\''.$type.' '.$type.'-'.$glyph_name.'\' style=\'color:'.$color.';'.$params.'\'></span>';
		} else {
			return '<span class=\''.$type.' '.$type.'-'.$glyph_name.'\' style=\'color:'.$color.'\'></span>';
		}
	}
}

// ATTENTION : Il faut faire un echo pour l'affichage !
function showLabel($label, $type = 'default') {
	return '<span class="label label-'.$type.'">'.$label.'</span>';
}

// Surligne en jaune fluo une chaîne de caractères
function colorize($data, $search, $color = '#ffff66') {
	if ($search != '' && stristr($data, $search)) {
		return str_ireplace($search, '<span style="background-color:'.$color.';">'.$search.'</span>', $data);
	} else {
		return $data;
	}
}

// Affiche un message d'alerte
// ATTENTION : Il faut faire un echo pour l'affichage !
function showMessage($message, $type = 'info') {
	switch ($type) {
		case 'success':
			return '<div class="alert alert-success" role="alert"><b>'.showGlyph('ok').'</b> '.$message.'</div>';
			break;

		case 'info':
			return '<div class="alert alert-info" role="alert"><b>'.showGlyph('search').'</b> '.$message.'</div>';
			break;

		case 'warning':
			return '<div class="alert alert-warning" role="alert"><b>'.showGlyph('warning-sign').'</b> '.$message.'</div>';
			break;

		case 'error':
			return '<div class="alert alert-danger" role="alert"><b>'.showGlyph('remove').'</b> '.$message.'</div>';
			break;

		default:
			return '<div class="alert alert-info" role="alert"><b>'.showGlyph('search').'</b> '.$message.'</div>';
			break;
	}
}

// Pagination d'un ensemble de données
function datasPagination($datas, $events_by_page, $page_needed) {
	$page_nbr = ceil(count($datas)/$events_by_page);
	$current_datas_paged = array_chunk($datas, $events_by_page, TRUE);
	if (!empty($datas)) {
		$datas_paged = array(	'page_number' => (int)$page_nbr,
								'page' => (int)$page_needed,
								'datas' => $current_datas_paged[($page_needed-1)]);
	} else {
		$datas_paged = array(	'page_number' => (int)$page_nbr,
								'page' => (int)$page_needed,
								'datas' => NULL);
	}

	return $datas_paged;
}

// Pied de pagination
function paginationFooter($pages_number, $current_page, $url) {
	// Préparation des données
	$footer = '';

	// Début du footer
	$footer .= '	<nav>
						<ul class="pagination pagination-sm">';

	// "Page précédente"
	if ($current_page > 1) {
		$footer .= '		<li><a href="'.$url.''.($current_page-1).'" data-toggle="tooltip" data-placement="top" title="'.ucfirst(userLang('general', 'PREVIOUS_PAGE')).'"><span aria-hidden="true">&laquo;</span><span class="sr-only">Précédent</span></a></li>';
	} else {
		$footer .= '		<li class="disabled"><a href="" data-toggle="tooltip" data-placement="top" title="'.ucfirst(userLang('general', 'PREVIOUS_PAGE')).'"><span aria-hidden="true">&laquo;</span><span class="sr-only">Précédent</span></a></li>';
	}

	// Pages afichées
	if (($current_page-3) > 0) {
		$footer .= '		<li><a href="'.$url.'1">1</a></li>';
	}

	if (($current_page-3) > 0 && ($current_page-3) != 1) {
		$footer .= '		<li><a href="'.$url.''.($current_page-3).'">...</a></li>';
	}

	if (($current_page-2) > 0) {
		$footer .= '		<li><a href="'.$url.''.($current_page-2).'">'.($current_page-2).'</a></li>';
	}

	if (($current_page-1) > 0) {
		$footer .= '		<li><a href="'.$url.''.($current_page-1).'">'.($current_page-1).'</a></li>';
	}

	$footer .= '			<li class="active"><a href="'.$url.''.$current_page.'">'.$current_page.'</a></li>';

	if (($current_page+1) < $pages_number) {
		$footer .= '		<li><a href="'.$url.''.($current_page+1).'">'.($current_page+1).'</a></li>';
	}

	if (($current_page+2) < $pages_number) {
		$footer .= '		<li><a href="'.$url.''.($current_page+2).'">'.($current_page+2).'</a></li>';
	}

	if (($current_page+3) < ($pages_number-1)) {
		$footer .= '		<li><a href="'.$url.''.($current_page+3).'">...</a></li>';
	}

	if ($current_page < $pages_number) {
		$footer .= '		<li><a href="'.$url.''.$pages_number.'">'.$pages_number.'</a></li>';
	}

	// "Page suivante"
	if ($current_page < $pages_number) {
		$footer .= '		<li><a href="'.$url.''.($current_page+1).'" data-toggle="tooltip" data-placement="top" title="'.ucfirst(userLang('general', 'NEXT_PAGE')).'"><span aria-hidden="true">&raquo;</span><span class="sr-only">Suivant</span></a></li>';
	} else {
		$footer .= '		<li class="disabled"><a href="" data-toggle="tooltip" data-placement="top" title="'.ucfirst(userLang('general', 'NEXT_PAGE')).'"><span aria-hidden="true">&raquo;</span><span class="sr-only">Suivant</span></a></li>';
	}

	// Fin du footer
	$footer .= '		</ul>
					</nav>';

	return $footer;
}
/*****************     FIN AFFICHAGE SITE     *****************/

/*****************     FONCTIONS DIVERSES     *****************/

// Export en CSV d'un tableau
function arrayCsv($array, $file, $delimiter = ';') {
	// On crée le fichier $file si il n'existe pas
	if (!file_exists(pathinfo($file)['dirname'])) {
		mkdir(pathinfo($file)['dirname'], 0764, TRUE);
	}
	$file_to_open = fopen($file, 'a');

	// Pour chage ligne de l'array on écrit l'info sous format csv dans $file
	foreach ($array as $fields) {
		fprintf($file_to_open, chr(0xEF).chr(0xBB).chr(0xBF)); // On écrit le header du fichier pour gérer l'utf-8
		fputcsv($file_to_open, $fields, $delimiter);	// On écrit la ligne csv en fonction du délimiter dans $file_to_open
	}

	// On ferme le fichier
	fclose($file_to_open);
}

// Transforme les secondes en heure complète
function TimeTransformation($time)	{
	if ($time>=86400)
	/* 86400 = 3600*24 c'est à dire le nombre de secondes dans un seul jour ! donc là on vérifie si le nombre de secondes donné contient des jours ou pas */
	{
	// Si c'est le cas on commence nos calculs en incluant les jours

	// on divise le nombre de seconde par 86400 (=3600*24)
	// puis on utilise la fonction floor() pour arrondir au plus petit
	$jour = floor($time/86400);
	// On extrait le nombre de jours
	$reste = $time%86400;

	$heure = floor($reste/3600);
	// puis le nombre d'heures
	$reste = $reste%3600;

	$minute = floor($reste/60);
	// puis les minutes

	$seconde = $reste%60;
	// et le reste en secondes

	// on rassemble les résultats en forme de date
	//$result = $jour.'j '.$heure.'h '.$minute.'min '.$seconde.'s';
	$result = $jour.'j '.$heure.'h';
	}
	elseif ($time < 86400 AND $time>=3600)
	// si le nombre de secondes ne contient pas de jours mais contient des heures
	{
	// on refait la même opération sans calculer les jours
	$heure = floor($time/3600);
	$reste = $time%3600;

	$minute = floor($reste/60);

	$seconde = $reste%60;

	//$result = $heure.'h '.$minute.'min '.$seconde.' s';
	$result = $heure.'h '.$minute.'min';
	}
	elseif ($time<3600 AND $time>=60)
	{
	// si le nombre de secondes ne contient pas d'heures mais contient des minutes
	$minute = floor($time/60);
	$seconde = $time%60;
	$result = $minute.'min '.$seconde.'s';
	}
	elseif ($time < 60)
	// si le nombre de secondes ne contient aucune minutes
	{
	$result = $time.'s';
	}
	return $result;
}
/*****************     FIN FONCTIONS DIVERSES     *****************/
?>
