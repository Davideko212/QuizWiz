<script lang='ts'>
	// The ordering of these imports is critical to your app working properly
	import '@skeletonlabs/skeleton/themes/theme-rocket.css';
	// If you have source.organizeImports set to true in VSCode, then it will auto change this ordering
	import '@skeletonlabs/skeleton/styles/all.css';
	// Most of your app wide CSS should be put in this file
	import '../app.postcss';

	import { AppShell, AppBar, LightSwitch, storePopup, Toast, Modal, Avatar, popup, modalStore, toastStore } from '@skeletonlabs/skeleton';
	import type { PopupSettings, ModalSettings } from '@skeletonlabs/skeleton';
	import { computePosition, autoUpdate, flip, shift, offset, arrow } from '@floating-ui/dom';
	storePopup.set({ computePosition, autoUpdate, flip, shift, offset, arrow });
    import { lightmode, userID } from '../stores';
    import ProfilePopup from '../components/ProfilePopup.svelte';

	let examplePopup: PopupSettings = {
		// Set the event as: click | hover | hover-click
		event: 'click',
		// Provide a matching 'data-popup' value.
		target: 'examplePopup',
		placement: 'bottom'
	};

	let lightmodeValue: boolean;
	lightmode.subscribe(value => {
		lightmodeValue = value;
	});

	let userIDValue: number;
	userID.subscribe(value => {
		userIDValue = value;
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
						<img src="/QuizWiz.png" style="width: 140px;">
					{:else}
						<img src="/QuizWiz_dark.png" style="width: 140px;">
					{/if}
				</a>
				<div id="heightPad"></div>
			</svelte:fragment>
			<svelte:fragment slot="trail">
				<div id="switch" on:click={switchLight}>
					<LightSwitch />
				</div>
				{#if userIDValue == 0}
					<a
						class="btn btn-sm variant-ghost-surface"
						href="/login"
					>
						Login
					</a>
				{:else}
					<div id="avatar" use:popup={examplePopup}>
						<Avatar
							border="border-4 border-surface-300-600-token hover:!border-primary-500"
							cursor="cursor-pointer"
							width="w-10"
						/>
					</div>
					<div class="card p-4 w-72 shadow-xl" data-popup="examplePopup">
						<ProfilePopup />
					</div>
				{/if}
			</svelte:fragment>
		</AppBar>
	</svelte:fragment>
	<!-- Page Route Content -->
	<slot />
</AppShell>

<!-- defining global (singleton) components-->
<Toast />
<Modal />

<style>
	#heightPad {
		min-height: 40px;
	}
</style>
