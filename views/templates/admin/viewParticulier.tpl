<div class="col-lg-12">
  <div class="panel clearfix">
    <div class="panel-heading">
      <i class="icon-briefcase"></i> {$particulier->lastname} {$particulier->firstname} [{"%06d"|sprintf:{$particulier->id_particulier}}]
    </div>
    <div class="form-horizontal">
      <div class="col-lg-6">
        <div class="row">
          <label class="control-label col-lg-3">{l s='Tél' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              <a href="tel:{$particulier->tel}">{$particulier->tel}</a>
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Mobile' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              <a href="tel:{$particulier->mobile}">{$particulier->mobile}</a>
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='E-mail' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              <a href="mailto:{$particulier->email}">{$particulier->email}</a>
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Site web' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              <a href="//{$particulier->website}" target="_blank">{$particulier->website}</a>
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Commentaire' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              {$particulier->commentaire}
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <label class="control-label col-lg-3">{l s='Adresse' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              <a href="http://www.google.com/maps/dir//{$particulier->address}, {$particulier->postal_code} {$particulier->ville}, {$particulier->pays}" target="_blank">{$particulier->address}</a>
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Code postal' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              {$particulier->postal_code}
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Ville' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              {$particulier->ville}
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Pays' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              {$particulier->pays}
            </p>
          </div>
        </div>
        <div class="row">
          <label class="control-label col-lg-3">{l s='Date du contact' mod='gsbtobs'}</label>
          <div class="col-lg-9">
            <p class="form-control-static">
              {$particulier->date_add|date_format:"%d-%m-%Y, %T"}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
