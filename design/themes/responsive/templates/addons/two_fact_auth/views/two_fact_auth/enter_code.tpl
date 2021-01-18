{script src="js/addons/two_fact_auth/func.js"}
{if $user_id}
        <form name="enter_code_form" action="{""|fn_url}" method="post">
        <div id="attempt_div">
            {if $pass == 'N'}
               <h1 style="color: crimson;">{__("incorrect_pass_try_again")}</h1>
            {/if}
            <input id="attempt_id" type="hidden" name="attempt_send_code" value="{$attempt_send_code}" />
            {if $attempt_send_code != 0}
                <h1>{__("attempts_left")}{3 - $attempt_send_code}</h1>
            {/if}
            <div class="ty-control-group">
                <label class="ty-login__filed-label cm-trim cm-required" for="code_id">{__("enter_code")}</label>
                {if $attempt_send_code == 3}
                    <h1>{__("enter_login_and_password_again")}</h1>
                {else}
                    <a 
                        href="#" 
                        id="send_new_code_link"
                        class="ty-password-forgot__a"  
                        tabindex="5">{__("send_code_again")}
                    </a>
                {/if}
            
                <input type="text" id="code_id" name="code" size="30" value="" class="ty-login__input cm-focus" />
            </div>
            <div class="buttons-container">
                {include 
                    file="buttons/button.tpl"
                    but_text=__("continue")
                    but_meta="ty-btn__secondary"
                    but_name="dispatch[two_fact_auth.check_code]"
                }
            </div>
             <!--attempt_div--></div>
        </form>
    {/if}
{capture name="mainbox_title"} {__("enter_code_to_fact_auth")} {/capture}