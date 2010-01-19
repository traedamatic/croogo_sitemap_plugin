<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc><?php echo Router::url('/',true); ?> </loc>
      <lastmod><?php echo trim($time->toAtom(time())); ?></lastmod>
      <changefreq>monthly</changefreq>
      <priority>1</priority>
   </url>
   <?php foreach ($nodes as $node): ?>
    <url>
        <loc> <?php echo Router::url($node[url],true) ?> </loc>
        <lastmod> <?php echo trim($time->toAtom(time())); ?> </lastmod>
        <priority> 0.8 </priority>
        <changefreq> weekly </changefreq>
    </url>
    <?php endforeach; ?>
</urlset> 
