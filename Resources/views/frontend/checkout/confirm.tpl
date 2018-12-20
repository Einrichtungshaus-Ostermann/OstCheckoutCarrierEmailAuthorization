
{* file to extend *}
{extends file="parent:frontend/checkout/confirm.tpl"}

{* set namespace *}
{namespace name="frontend/ost-checkout-carrier-email-authorization/checkout/confirm"}



{block name="frontend_checkout_confirm_agb"}
    {if $dprivacy.before != true}
        {$smarty.block.parent}
    {/if}

    {if $dprivacy.enabled}
        <li class="block-group row--dprivacy">
            {block name='frontend_checkout_confirm_dprivacy_checkbox'}
                <span class="block column--checkbox">
                {if !{config name='IgnoreDPrivacy'}}
                    <input type="checkbox" required="required" aria-required="true" id="sDPrivacy" name="sDPrivacy"/>
                {/if}
            </span>
            {/block}

            {* DPrivacy label *}
            {block name='frontend_checkout_confirm_dprivacy_label'}
                <span class="block column--label">
                <label for="sDPrivacy" data-height="500"
                       data-width="750">{s name="DispatchPrivacy"}Ja, ich bin damit einverstanden, dass meine Email Adresse an den Versanddienstleister übermittelt wird.{/s}
                </label>
            </span>
            {/block}
        </li>
    {/if}

    {if $dprivacy.before == true}
        {$smarty.block.parent}
    {/if}
{/block}
