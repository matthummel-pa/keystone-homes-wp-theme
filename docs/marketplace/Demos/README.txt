Keystone demo content
=====================

Preferred (matches the live concept site):

  WordPress admin → Tools → Seed Keystone demo
  or: wp ks seed

That creates the marketing pages, sample listings, agents, blog posts, and
Primary / Footer menus. It is safe to run again.

Manual import
-------------

If you need Tools → Import → WordPress (WXR):

  1. Activate Keystone Real Estate (and Keystone Core if you use the plugin).
  2. Install the official WordPress Importer from wordpress.org if asked.
  3. Import a WXR you export from a seeded site:
       wp export --path="$HOME/wp" --dir=./Demos

Do not place .xml or .zip files inside the theme folder for a WordPress.org
upload. Keep demo files beside the theme zip in this pack.

Photos
------

Concept photos are Unsplash hotlinks. They are not bundled. Replace them with
your own media library uploads on a client site.
