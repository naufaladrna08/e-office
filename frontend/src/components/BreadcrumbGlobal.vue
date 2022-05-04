<template>
  <div>
    <nav aria-label="breadcrumb fixed-top">
      <ol class="breadcrumb py-4">
        <li
          v-for="(crumb, ci) in crumbs"
          :key="ci"
          class="breadcrumb-item"
        >
          <template v-if="ci < 1">
            <a href="#" :class="{ disabled: isLast(ci) }" @click="selected(crumb)">
              <i class="fa fa-home"></i>
            </a>
          </template>
          <template v-else>
            <a href="#" :class="{ disabled: isLast(ci) }" @click="selected(crumb)">
              {{ crumb }}
            </a>
          </template>
        </li>
      </ol>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'BreadcrumbGlobal',
  props: {
    crumbs: {
      type: Array, 
      required: true
    }
  },
  methods: {
    isLast(id) {
      return id === this.crumbs.length - 1
    },
    selected(crumb) {
      this.$emit('selected', crumb)
    }
  }
}
</script>