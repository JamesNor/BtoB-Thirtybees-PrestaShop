<div class="col-lg-6">
  <div class="panel clearfix">
    <div class="panel-heading">
      <i class="icon-briefcase"></i> {$gsbtob->name} [{"%06d"|sprintf:{$gsbtob->id_gsbtob}}]
      {if $admin_customer_link ne ''}<a href="mailto:{$gsbtob->email}"><i class="icon-envelope"></i>
						{$gsbtob->email}
			</a>
      {/if}
      <div class="panel-heading-action">
        {if $gsbtob->employe ne ''}
        <a href="{$employe_url}"><i class="icon-user"></i>
  						{$gsbtob->employe}
  			</a>
        {else}
        <a href="{$employe_url}"><i class="icon-info"></i>
  						Ajoutez un contact commercial
  			</a>
        {/if}
      </div>
    </div>
    <div class="form-horizontal">
      <div class="row">
        <label class="control-label col-lg-3">{l s='Nom' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->name}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Type' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->type}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='E-mail' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {if $admin_customer_link ne ''}<a href="{$admin_customer_link}">{/if}{$gsbtob->email}{if $admin_customer_link ne ''}</a>{/if}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Fax' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->fax}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Tél' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->tel}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Site web' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->website}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-6">
  <div class="panel clearfix">
    <div class="panel-heading">
      <i class="icon-info"></i> Informations complémentaires
    </div>
    <div class="form-horizontal">
      <div class="row">
        <label class="control-label col-lg-3">{l s='SIRET' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->siret}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Status' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {if $gsbtob->status}Client{else}Prospe{/if}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Numéro de TVA' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->tva_number}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Type de TVA' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->tva_type}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Secteur d\'activité' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->activite}
          </p>
        </div>
      </div>
      <div class="row">
        <label class="control-label col-lg-3">{l s='Type' mod='gsbtobs'}</label>
        <div class="col-lg-9">
          <p class="form-control-static">
            {$gsbtob->type}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="panel clearfix">
    <div class="panel-heading">
      <i class="icon-map-marker"></i> Adresses
    </div>
    <table class="table">
      <thead>
        <tr>
          <th><span class="title_box ">Adresse</span></th>
          <th><span class="title_box ">Code Postal</span></th>
          <th><span class="title_box ">Ville</span></th>
          <th><span class="title_box ">Pays</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{$gsbtob->address}</td>
          <td>{$gsbtob->postal_code}</td>
          <td>{$gsbtob->ville}</td>
          <td>{$gsbtob->pays}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="col-lg-12">
  <div class="panel clearfix">
    <div class="panel-heading">
      <i class="icon-user"></i> Contacts
    </div>
    <table class="table">
      <thead>
        <tr>
          <th><span class="title_box ">Nom</span></th>
          <th><span class="title_box ">Fonction</span></th>
          <th><span class="title_box ">E-mail</span></th>
          <th><span class="title_box ">Tél</span></th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$customers item=customer}
        <tr>
          <td>{$customer['lastname']} {$customer['firstname']}</td>
          <td>{$customer['id_gender']}</td>
          <td>{$customer['email']}</td>
          <td>{$customer->pays}</td>
        </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>
