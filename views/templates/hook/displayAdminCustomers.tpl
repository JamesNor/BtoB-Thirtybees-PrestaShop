{if !empty($compagnies)}
<div class="panel" id="product-tab-content-gsbtobs">
	<div class="panel-heading" id="product-gsbtobs">
		<i class="icon-briefcase"></i> {l s='Compagny' mod='gsbtobs'}
		<span class="badge">{$compagnies|count}</span>
		<div class="panel-heading-action">
			<a class="btn btn-default" href="{$action_url}&addgsbtob">
			<i class="icon-plus-sign"></i>
			Ajouter
		</a>
		</div>
	</div>

	<table class="table" style="width:100%">
		<thead>
			<tr>
				<th><span class="title_box">{l s='ID' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='Name' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='Siret' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='Capital' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='E-mail' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='Tel' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='Fax' mod='gsbtobs'}</span></th>
				<th><span class="title_box">{l s='Website' mod='gsbtobs'}</span></th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$compagnies item=compagny}
			<tr onclick="document.location = '{$action_url}&id_gsbtob={$compagny.id_gsbtob}&viewgsbtob'">
				<td>#{$compagny.id_gsbtob}</td>
				<td>{$compagny.name}</td>
				<td>{$compagny.siret}</td>
				<td>{$compagny.capital}</td>
				<td><a href="mailto:{$compagny.email}">{$compagny.email}</a></td>
				<td>{$compagny.tel}</td>
				<td>{$compagny.fax}</td>
				<td><a href="http://{$compagny.website}">{$compagny.website}</a></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
<style media="screen">
	#product-tab-content-gsbtobs tr:hover td{
		cursor: pointer;
	}
</style>
{/if}
