type InternalStatus = {
  application: string
  scope: string
  status: string
}

export const useInternalStatus = () => {
  const config = useRuntimeConfig()

  return useFetch<InternalStatus>('/internal/status', {
    baseURL: config.public.apiBaseUrl,
  })
}
