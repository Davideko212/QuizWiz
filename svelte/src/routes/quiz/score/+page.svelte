<script lang="ts">
	import { ConicGradient } from '@skeletonlabs/skeleton';
	import type { ConicStop } from '@skeletonlabs/skeleton';
	import { answers } from '../../../stores.js';

	const conicStops: ConicStop[] = [
		{ color: 'rgba(102, 255, 102,1)', start: 0, end: 10 },
		{ color: 'rgba(255, 80, 80, 1)', start: 10, end: 35 },
		{ color: 'rgba(255, 255, 102, 1)', start: 35, end: 60 },
		{ color: 'rgba(179, 179, 179, 1)', start: 60, end: 100 }
	];

	for (const [key, value] of Object.entries($answers)) {
		// TODO
	}
</script>

<main>
	<h1>QUIZ SCORE</h1>


	<ConicGradient stops={conicStops}>(caption)</ConicGradient>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
	}
</style>
