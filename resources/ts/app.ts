import "./bootstrap.ts";
//@ts-ignore
import.meta.glob(["../images/**"]);
//@ts-ignore
const modules = import.meta.glob("./*.ts", { eager: true });
