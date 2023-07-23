<template>
  <div>
    <VOnboardingWrapper ref="wrapper" :steps="steps" />

    <div style="absolute">
      <iframe
        ref="usersIframe"
        src="/nova/resources/users"
        style="
          width: 100%;
          height: calc(100vh - 100px);
          position: fixed;
          top: 0px;
          left: 0;
          border: none;
          z-index: 1;
        "
      ></iframe>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted, nextTick, onBeforeMount } from "vue";
import { VOnboardingWrapper, useVOnboarding } from "v-onboarding";
import "v-onboarding/dist/style.css";

export default defineComponent({
  components: {
    VOnboardingWrapper,
  },
  setup() {
    const wrapper = ref(null);
    const { start, goToStep, finish } = useVOnboarding(wrapper);

    const usersViewUrl = "/nova/resources/users";


    const steps = [
      {
        attachTo: {
          element:
            "#nova > div:nth-child(1) > div > div > div.bg-white.dark\\:bg-gray-800.relative.flex-1.flex.flex-col.max-w-xxs.w-full > div.overflow-x-auto > div > div:nth-child(2) > div > div > a > span.sidebar-item-label.flex.items-center",
        },
        content: { title: "Welcome to Onboarding process for users!" },
        on: {
          afterStep: () => {
            const hamburgerIcon = document.querySelector(
              "#nova > div:nth-child(1) > header > button > svg"
            );
            if (hamburgerIcon) {
              hamburgerIcon.parentElement.click();
            }
          },
        },
      },
      {
        attachTo: {
          element:
            "#nova > div:nth-child(2) > div.p-4.md\\:py-8.md\\:px-12.lg\\:ml-60.space-y-8 > div.mt-8.leading-normal.text-xs.text-gray-500.space-y-1 > p:nth-child(1)",
        },
        content: { title: "Welcome to the Users View!" },
      },
      {
        attachTo: {
          element:
            "#nova > div:nth-child(2) > div.p-4.md\\:py-8.md\\:px-12.lg\\:ml-60.space-y-8 > div.mt-8.leading-normal.text-xs.text-gray-500.space-y-1 > p:nth-child(2)",
        },
        content: { title: "Finally you can create your user here! Have fun!" },
        on: {
          afterStep: () => {
            window.location.href = "/nova/resources/users";
          },
        },
      },
    ];

    onBeforeMount(async () => {
      try {
        const response = await fetch("/api/onboarding-steps");
        if (!response.ok) {
          throw new Error("Failed to fetch onboarding steps");
        }
        const data = await response.json();
        console.log("data", data)

        steps.value = steps.map((step, index) => {
          const { attachTo, content, ...rest } = data[index];
          return {
            ...step,
            attachTo: {
              element: step.attach_to_selector,
            },
            content: {
              title: step.title,
            },
            ...rest, // Preserve other properties of the step
          };
        });
      } catch (error) {
        console.error(error);
      }
    });

    onMounted(async () => {
      const hamburgerIcon = document.querySelector(
        "#nova > div:nth-child(1) > header > button > svg"
      );
      if (hamburgerIcon) {
        hamburgerIcon.parentElement.click();
      }

      const iframe = ref.usersIframe;
      if (iframe) {
        iframe.src = usersViewUrl;
        iframe.addEventListener("load", () => {
          start();
        });
      }

      nextTick(() => {
        start();
      });
    });

    return {
      wrapper,
      steps,
      start,
      finish,
      goToStep,
    };
  },
});
</script>

<style>
/* Scoped Styles */
</style>
