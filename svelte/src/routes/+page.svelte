<script lang="ts">

    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";

	import { popup } from '@skeletonlabs/skeleton';
	import type { PopupSettings } from '@skeletonlabs/skeleton';

	let examplePopup: PopupSettings = {
		// Set the event as: click | hover | hover-click
		event: 'click',
		// Provide a matching 'data-popup' value.
		target: 'examplePopup',
		placement: 'bottom'
	};

</script>

<main>
	<img src="/QuizWiz.png">
	<CategorySelect />
	<QuestionSelect />
	<button type="button" class="btn variant-filled">
		Quiz Starten
	</button>
	<button class="btn variant-filled" use:popup={examplePopup}>Trigger</button>
	<div class="card p-4 w-72 shadow-xl" data-popup="examplePopup">
		<div class="space-y-4">
			<div>
				<p class="font-bold">Skeleton</p>
				<p class="opacity-50">@SkeletonUI</p>
			</div>
			<p>Skeleton is a fully featured UI component library using the power of Svelte + Tailwind.</p>
			<div class="flex gap-4">
				<small><strong>50</strong> <span class="opacity-50">Following</span></small>
				<small><strong>440</strong> <span class="opacity-50">Followers</span></small>
			</div>
			<a class="btn variant-soft w-full" href="https://twitter.com/SkeletonUI" target="_blank" rel="noreferrer">
				View on Twitter
			</a>
		</div>
		<!-- Arrow -->
		<div class="arrow bg-surface-100-800-token" />
	</div>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
	}

	img {
		width: 40%;
	}
</style>
