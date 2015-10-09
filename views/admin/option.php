<div class="wrap">
	<h1><?php _e('Taxonomies Tweaker', 'taxonomy_tweaker') ?></h1>
	<p>test</p>
	<form action="admin.php?page=taxonomies-tweaker.php" method="post">
		<table class="form-table">
			<tr>
				<th><?php _e('Checkboxes sorting', 'taxonomy_tweaker') ?></th>
				<td><label for="checked_on_top"> <input type="hidden" value="0"
						name="tt[disable_checked_on_top]" /> <input type="checkbox"
						value="1" name="tt[disable_checked_on_top]"
						id="disable_checked_on_top"
						<?php echo ($options['disable_checked_on_top'] ? 'checked="checked"' : '') ?> />
						<?php _e('Disable checked taxonomies on top', 'taxonomy_tweaker')?>
					</label>
					<p class="description"><?php _e('Check if checked taxonomies shouldn\'t be displayed first.', 'taxonomy_tweaker')?></p>
				</td>
			</tr>
			<tr>
				<th><?php _e('Check children with parent', 'taxonomy_tweaker') ?></th>
				<td><label for="children_with_parent"> <input type="hidden"
						value="0" name="tt[children_with_parent]" /> <input
						type="checkbox" value="1" name="tt[children_with_parent]"
						id="children_with_parent"
						<?php echo ($options['children_with_parent'] ? 'checked="checked"' : '') ?> />
						<?php _e('Check children checkboxes with parent checkbox', 'taxonomy_tweaker')?>
					</label></td>
			</tr>
		</table>
		<?php submit_button()?>
	</form>
</div>
<!-- end .wrap -->