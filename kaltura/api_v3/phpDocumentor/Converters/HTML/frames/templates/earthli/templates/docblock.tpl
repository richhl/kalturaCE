<!-- ========== Info from phpDoc block ========= -->
{if $sdesc}
<p class="short-description">{$sdesc}</p>
{/if}
{if $desc}
<p class="description">{$desc}</p>
{/if}
{if $tags}
	<ul class="tags">
		{section name=tags loop=$tags}
		{if $tags[tags].keyword eq 'readonly'}
		<li><span class="field custom">{$tags[tags].keyword}</span></li>
		{else}
		<li><span class="field">{$tags[tags].keyword}:</span> {$tags[tags].data}</li>
		{/if}
		{/section}
	</ul>
{/if}
