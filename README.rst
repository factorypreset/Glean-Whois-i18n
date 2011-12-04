i18n-ified Glean Whois tools
============================

Project
-------

This is an attempt to internationalize the Glean Whois web site, which is 
one of the tools offered by PLML.org. This first attempt was made as part
of RHoK2 Boston (3-4 Dec 2011).

The project team at RHoK2 was:

* Dave Crusoe (sponsor)
* Bo Daley
* Seth Madison
* Liz Kolster
* Sheeran
* Jonah Goldstein

Approach
--------

The site already had some rudimentary support for multiple languages. We 
determined that the appropriate approach was to convert this to standard
gettext format so we could make use of existing open source translation 
tools.

We wrote a script that converted the files from their initial format 
(which is common to all the PLML sites) into standard gettext format.

We were then able to use POEdit (freely available tool for Mac, Linux 
and Windows) to make some initial translations.

We then hooked up Pootle, an open source translation app. This allows 
translators around the world to contribute translations for PLML sites.




