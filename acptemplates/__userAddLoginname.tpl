{if MODULE_SYSTEM_LOGINNAME}
	<dl{if $errorType.loginname|isset} class="formError"{/if}>
		<dt><label for="loginname">{lang}wcf.user.loginname{/lang}</label></dt>
		<dd>
			<input type="text" id="loginname" name="loginname" value="{$loginname}" pattern="^[^,\n]+$" autofocus="autofocus" class="medium" />
			{if $errorType.loginname|isset}
				<small class="innerError">
					{if $errorType.loginname == 'empty'}
						{lang}wcf.global.form.error.empty{/lang}
					{else}
						{lang}wcf.user.loginname.error.{@$errorType.loginname}{/lang}
					{/if}
				</small>
			{/if}
		</dd>
	</dl>
{/if}