jQuery(document).ready(function($) {
	$("div[id^=taxonomy-] input[type=checkbox]").click(function() {
		var e = $(this);
		// check if checkbox parent li contains ul (children checboxes)
		var c = e.parents("li").first().find("ul");
		if (c.length) {
			// iterate through each children checboxes
			c.find("input[type=checkbox]").each(function() {
				// set same checked property as parent checkbox
				$(this).prop("checked", e.prop("checked"));
			});
		}
	});
})