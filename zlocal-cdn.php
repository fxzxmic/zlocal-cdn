global $Wcms;
function replace_assets($args) {
	global $Wcms;
	$assets = [
		"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css",
		"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js",
		"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js",
		"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js",
		"https://cdn.jsdelivr.net/gh/robiso/wondercms-cdn-files@3.1.8/wcms-admin.min.css",
		"https://cdn.jsdelivr.net/gh/robiso/wondercms-cdn-files@3.1.9/wcms-admin.min.js",
		"https://cdn.jsdelivr.net/npm/taboverride@4.0.3/build/output/taboverride.min.js",
		"https://cdn.jsdelivr.net/npm/autosize@4.0.2/dist/autosize.min.js"
	];
	foreach($assets as $remote) {
		$name = basename($remote);
		$local = $Wcms->url("plugins/zlocal-cdn/assets/$name");
		$args[0] = str_replace($remote, $local, $args[0]);
		// Download files
		if(!file_exists(__DIR__ . "/assets/$name")) {
			file_put_contents(__DIR__ . "/assets/$name", file_get_contents($remote));
		}
	}
	return $args;
}
$Wcms->addListener('js', 'replace_assets');
$Wcms->addListener('css', 'replace_assets');
