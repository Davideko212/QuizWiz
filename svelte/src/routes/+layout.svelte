<script lang='ts'>
	import '@skeletonlabs/skeleton/themes/theme-rocket.css';
	import '@skeletonlabs/skeleton/styles/all.css';
	import '../app.postcss';

	import { AppShell, AppBar, LightSwitch, storePopup, Toast, Modal, Avatar, popup, type PopupSettings } from '@skeletonlabs/skeleton';
	import { computePosition, autoUpdate, flip, shift, offset, arrow } from '@floating-ui/dom';
    import { lightmode, userID } from '../stores';
    import ProfilePopup from '../components/ProfilePopup.svelte';

	storePopup.set({ computePosition, autoUpdate, flip, shift, offset, arrow });

	let examplePopup: PopupSettings = {
		// Set the event as: click | hover | hover-click
		event: 'click',
		// Provide a matching 'data-popup' value.
		target: 'examplePopup',
		placement: 'bottom'
	};

	function switchLight() {
		lightmode.set(!$lightmode);
	}
</script>

<style>
	#heightPad {
		min-height: 40px;
	}
</style>

<!-- App Shell -->
<AppShell>
	<svelte:fragment slot="header">
		<!-- App Bar -->
		<AppBar>
			<svelte:fragment slot="lead">
				<a href="http://localhost/QuizWiz/svelte/build/">
					{#if $lightmode}
						<img src="http://localhost/QuizWiz/svelte/build/QuizWiz.png" style="width: 140px;">
					{:else}
						<img src="http://localhost/QuizWiz/svelte/build/QuizWiz_dark.png" style="width: 140px;">
					{/if}
				</a>
				<div id="heightPad"></div>
			</svelte:fragment>
			<svelte:fragment slot="trail">
				<div id="switch" on:click={switchLight}>
					<LightSwitch />
				</div>
				{#if $userID == 0}
					<a
						class="btn btn-sm variant-ghost-surface"
						href="http://localhost/QuizWiz/svelte/build/login.html"
					>
						Login
					</a>
				{:else}
					<div id="avatar" use:popup={examplePopup}>
						<Avatar
							border="border-4 border-surface-300-600-token hover:!border-primary-500"
							cursor="cursor-pointer"
							width="w-10"
							initials="👤"
						/>
					</div>
					<div class="card p-4 w-80 shadow-xl" data-popup="examplePopup">
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
