<template>
	<div>
		<h4 v-if="!expire" class="text-bold text-red text-center" :class="{'text-yellow':blinker}">
			{{ days > 0 ? days+'d ' : ''}}
			{{ hours > 0 ? hours+'h ' : ''}}
			{{ minutes > 0 ? minutes+'m ' : ''}}
			{{ seconds > 0 ? seconds+'s ' : ''}}
		</h4>
		<h4 v-else class="text-bold text-red text-center">Timeout</h4>
	</div>
</template>

<script>
export default {
	props: {
		'room' : {
			type: String
		},
		'checkout' : {
			type: String
		},
		'timeRemaining' : {
			type: String
		},
	}
	,
	data() {
		return {
			diff: 0,
			now : Math.trunc(new Date().getTime() / 1000),
			checkoutCount: 0,
			blinker : false,
			warning : false,
			expire: false,
			interval: null,
			warnInterval : null,
		};
	},
	computed:{
		seconds() {
            return Math.trunc(this.diff) % 60
        },
        minutes() {
            return Math.trunc(this.diff / 60) % 60
        },
        hours() {
            return Math.trunc(this.diff / 60 / 60) % 24
        },
        days() {
            return Math.trunc(this.diff / 60 / 60 / 24)
        }
	},
	watch: {
		now(value){
            this.diff = this.checkoutCount - this.now;
            
            this.warning = this.diff < 900;

            if(this.diff <= 0 && !this.expire){
            	this.expire = true;
            	clearInterval(this.interval);
            	clearInterval(this.warnInterval);
            }
		},
		warning(value){
			if (this.warning){
				this.warnInterval = setInterval(() => {
					this.blinker = !this.blinker;
				}, 600);
			}
			if(value){
			} else {
				this.blinker = false;
				clearInterval(this.warnInterval);
			}
		}
	},
	mounted() {
		if(!this.checkout)
		{
			throw new Error("Missing checkout date");
		}
		this.checkoutCount = new Date(this.checkout).getTime() / 1000;

		this.interval = setInterval(() => {
			this.now = Math.trunc(new Date().getTime() / 1000);
		}, 1000);
	},
	destroyed() {
		clearInterval(interval)
	}
}
</script>