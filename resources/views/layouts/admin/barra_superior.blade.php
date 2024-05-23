<div wire:snapshot="{&quot;data&quot;:[],&quot;memo&quot;:{&quot;id&quot;:&quot;2WalgzC1zl6NC32CLUwk&quot;,&quot;name&quot;:&quot;index-cards&quot;,&quot;path&quot;:&quot;\/&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;},&quot;checksum&quot;:&quot;3ec6499150cebc75db86015e8d66cae1610eafccf1b98200be916b7faf4b4c12&quot;}"
    wire:effects="[]" wire:id="2WalgzC1zl6NC32CLUwk" class="row first">
    <!--[if BLOCK]><![endif]-->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card sombra">
            <a href="{{ route('tickets', '3') }}" data-hint="Haga click en el título y lo llevara al modulo de ticket"
                data-hint-position="top-right" data-hint-alwaysVisible="true" onclick=" loading_show();">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-1">
                            <i class="fa fa-ticket" aria-hidden="true"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">@lang('Tickets New')</div>
                            <div class="dash-counts">
                                <p>{{ $tickets }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card sombra">
            <a href="{{ route('users') }}" onclick=" loading_show();">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-2">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">@lang('Registrate Users')</div>
                            <div class="dash-counts">
                                <p>{{ $user }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card sombra">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-3">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Invoices</div>
                        <div class="dash-counts">
                            <p>1,041</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card sombra">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-4">
                        <i class="far fa-file"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Estimates</div>
                        <div class="dash-counts">
                            <p>2,150</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--[if ENDBLOCK]><![endif]-->
</div>
