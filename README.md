## About Generator UI
This module adds Site API key field in the site information form. It also represents page nodes in JSON format if site API key is available.

You can access site information form like this: {base_url}/admin/config/system/site-information
Ex: http://localhost/drupal8/admin/config/system/site-information

And you can access JSON page like this:  {base_url}/page_json/{siteapikey}/{nodeid}
Ex: http://localhost/drupal8/page_json/ABC132UDEY/1

Install this folder in modules/custom folder

Rename siteinfo-master to siteinfo

## Dependencies

Please enable Serialization module before enabling this module.

Developer: Kalyani Sehagl
Total time to complete the tasl: 4 hours
Resources: Internet
