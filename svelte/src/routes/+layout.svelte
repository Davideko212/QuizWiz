<script lang='ts'>
	// The ordering of these imports is critical to your app working properly
	import '@skeletonlabs/skeleton/themes/theme-rocket.css';
	// If you have source.organizeImports set to true in VSCode, then it will auto change this ordering
	import '@skeletonlabs/skeleton/styles/all.css';
	// Most of your app wide CSS should be put in this file
	import '../app.postcss';
	import { AppShell, AppBar, LightSwitch } from '@skeletonlabs/skeleton';

	import { computePosition, autoUpdate, flip, shift, offset, arrow } from '@floating-ui/dom';
	import { storePopup } from '@skeletonlabs/skeleton';
	storePopup.set({ computePosition, autoUpdate, flip, shift, offset, arrow });
	import { Toast } from '@skeletonlabs/skeleton';
	import { Modal } from '@skeletonlabs/skeleton';
    import { lightmode } from '../stores';

	let lightmodeValue: boolean;
	lightmode.subscribe(value => {
		lightmodeValue = value;
	});

	function switchLight() {
		lightmode.set(!lightmodeValue);
		console.log(lightmodeValue);
	}
</script>

<!-- App Shell -->
<AppShell>
	<svelte:fragment slot="header">
		<!-- App Bar -->
		<AppBar>
			<svelte:fragment slot="lead">
				<a href="/">
					{#if lightmodeValue}
						<img src="/QuizWiz.png" style="width: 120px;">
					{:else}
						<img src="/QuizWiz_dark.png" style="width: 120px;">
					{/if}
				</a>
			</svelte:fragment>
			<svelte:fragment slot="trail">
				<div id="switch" on:click={switchLight}>
					<LightSwitch />
				</div>
				<a
					class="btn btn-sm variant-ghost-surface"
					href="/login"
				>
					Login
				</a>
			</svelte:fragment>
		</AppBar>
	</svelte:fragment>
	<!-- Page Route Content -->
	<slot />
</AppShell>

<!-- defining global (singleton) components-->
<Toast />
<Modal />
