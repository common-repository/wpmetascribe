=== wpMetaScribe ===
Contributors: questrcreative
Donate link: http://metascribe.questrcreative.com
Tags: user_meta, permissions, filters
Requires at least: 3.1
Tested up to: 3.41
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Tools to get the most from meta tag. Permission to view page, and a content filter

== Description ==

There are two commands 

[ums_permission] and [usm_content]

Both look at the parameters passed in the short code to determine if that user can access content. 

If the permission test fails - the following will not happen.

With [ums_permission] the page will not fully load. The ability to return to the home page still exists.
Often wrapping the entire content with a [usm_content] tag would be more useful 

with [usm_content] the content between the [ums_content] and [/usm_content] will be displayed 

The parameter is called allowed - although any parameter starting with "allow" will work multiple 
parameters can be passed. in the paramter is a string that holds either 

the meta_key that if it exists permission is granted or the meta_key and meta_value conbimation seperated by an :

forexample

[usm_permission allowed="employee"] 
Any one that does not have the meta employee will not be able to load that page. A very minimal page loads. 

[usm_content allowed = "employee" allow2 = "associate_class:1"]We roll the new site out for testing tuesday[/usm_content]

Any one that has the meta_tag of employee or meta_tag of associate_class and a value of 1 can see the text.


== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.0 =
* First release

