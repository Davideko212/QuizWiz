<script lang="ts">
    import { RangeSlider } from '@skeletonlabs/skeleton';
    import StarRating from 'svelte-star-rating';

    export let value: number;
    $: diff = value/2;

    const config = {
        emptyColor: 'hsl(240, 80%, 85%)',
        fullColor: '#ff5900',
        size: 32,
    };
</script>

<main>
    <div id="container">
        <div id="slider">
            <StarRating rating={diff} {config} />
            <div id="test">
                <RangeSlider name="range-slider" bind:value min={1} max={10} step={1} />
            </div>
        </div>
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

    #container {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 50%;
    }

    #slider {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>