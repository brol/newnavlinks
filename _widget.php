<?php
/**
 * @brief New Navigation Links, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @author Moe, Pierre Van Glabeke and contributors
 *
 * @copyright GPL-3.0 https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Icon (icon.png) and images are from Silk Icons :
 * <http://www.famfamfam.com/lab/icons/silk/>
 */
if (!defined('DC_RC_PATH')) {exit;}

dcCore::app()->addBehavior('initWidgets',array('NewNavLinksBehaviors','initWidgets'));
 
class NewNavLinksBehaviors
{
	public static function initWidgets($w)
	{
		$w->create('NewNavLinks',__('New Navigation Links'),
			array('NewNavLinksBehaviors','Show'));

		$w->NewNavLinks->setting('home',__('Home').': ('.__('optional').')',
			__('Home'),'text');

		$w->NewNavLinks->setting('homeonhome',
			__('Display link to Home page on Home page'),true,'check');

		$w->NewNavLinks->setting('archives',__('Archives').': ('.
			__('optional').')',__('Archives'),'text');

		$w->NewNavLinks->setting('archonarch',
			__('Display link to Archives on Archives page'),true,'check');

		$tags_list = array('h2','h3','h4','p');
		$tags = array();
		
		foreach ($tags_list as $tag)
		{
			$tags[html::escapeHTML('<'.$tag.'>')] = $tag;
		}
		
		$w->NewNavLinks->setting('tag',html::escapeHTML(__('Tag to use:')),
			'2','combo',$tags);
			
		$w->NewNavLinks->setting('homeonly',__('Display on:'),0,'combo',
			array(
				__('All pages') => 0,
				__('Home page only') => 1,
				__('Except on home page') => 2
				)
		);
		$w->NewNavLinks->setting('content_only',__('Content only'),0,'check');
		$w->NewNavLinks->setting('class',__('CSS class:'),'');
		$w->NewNavLinks->setting('offline',__('Offline'),0,'check');
	}
	
	public static function Show($w)
	{
		if ($w->offline) {
            return;
        }

        if (!$w->checkHomeOnly(dcCore::app()->url->type)) {
            return;
        }

		$elements = array();
		if ((strlen($w->home) > 1) AND (((dcCore::app()->url->type == 'default')
			AND ($w->homeonhome)) OR (dcCore::app()->url->type != 'default'))) 
		{
			$elements[] = '<a href="'.dcCore::app()->blog->url.'">'.html::escapeHTML($w->home).'</a>';
		}

		if ((strlen($w->archives) > 0) AND (((dcCore::app()->url->type == 'archive')
			AND ($w->archonarch)) OR (dcCore::app()->url->type != 'archive')))
		{
			$elements[] = '<a href="'.dcCore::app()->blog->url.
				dcCore::app()->url->getBase("archive").'">'.
				html::escapeHTML($w->archives).'</a>';
		}

		if (count($elements) > 0)
		{
			$str = implode('<span> - </span>',$elements);
			$class = ($w->tag == 'p') ? ' class="text"' : '';

		$res =
		'<'.$w->tag.$class.'>'.$str.'</'.$w->tag.'>';

		return $w->renderDiv($w->content_only,'newnav '.$w->class,'',$res);
		}
	}
}