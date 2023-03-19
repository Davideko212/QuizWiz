<script>
    import Slider from '@smui/slider';
    import StarRating from 'svelte-star-rating';

    export let value;
    let diff = value/2;
</script>

<main>
    <div id="container">
        <div id="slider">
            <Slider bind:value min={1} max={10} />
            <!-- TODO: AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA -->
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
    }
</style>